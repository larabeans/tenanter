<?php

namespace App\Containers\Vendor\Tenanter\Resolvers;

use App\Containers\Vendor\Tenanter\Contracts\Tenant;
use App\Containers\Vendor\Tenanter\Exceptions\TenantCouldNotBeIdentifiedByRequestDataException;

class RequestDataTenantResolver extends Contracts\CachedTenantResolver
{
    /** @var bool */
    public static $shouldCache = false;

    /** @var int */
    public static $cacheTTL = 3600; // seconds

    /** @var string|null */
    public static $cacheStore = null; // default

    public function resolveWithoutCache(...$args): Tenant
    {
        $payload = $args[0];

        if ($payload && $tenant = tenancy()->find($payload)) {
            return $tenant;
        }

        throw new TenantCouldNotBeIdentifiedByRequestDataException($payload);
    }

    public function getArgsForTenant(Tenant $tenant): array
    {
        return [
            [$tenant->id],
        ];
    }
}
