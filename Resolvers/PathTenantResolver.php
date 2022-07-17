<?php

namespace App\Containers\Larabeans\Tenanter\Resolvers;

use Illuminate\Routing\Route;
use App\Containers\Larabeans\Tenanter\Contracts\Tenant;
use App\Containers\Larabeans\Tenanter\Exceptions\TenantCouldNotBeIdentifiedByPathException;

class PathTenantResolver extends Contracts\CachedTenantResolver
{
    public static $tenantParameterName = 'tenant';

    /** @var bool */
    public static $shouldCache = false;

    /** @var int */
    public static $cacheTTL = 3600; // seconds

    /** @var string|null */
    public static $cacheStore = null; // default

    public function resolveWithoutCache(...$args): Tenant
    {
        /** @var Route $route */
        $route = $args[0];

        if ($id = $route->parameter(static::$tenantParameterName)) {
            $route->forgetParameter(static::$tenantParameterName);

            if ($tenant = tenancy()->findTenant($id)) {
                return $tenant;
            }
        }

        throw new TenantCouldNotBeIdentifiedByPathException($id);
    }

    public function getArgsForTenant(Tenant $tenant): array
    {
        return [
            [$tenant->id],
        ];
    }
}
