<?php

namespace App\Containers\Vendor\Tenanter\Resolvers;

use Illuminate\Database\Eloquent\Builder;
use App\Containers\Vendor\Tenanter\Contracts\Domain;
use App\Containers\Vendor\Tenanter\Contracts\Tenant;
use App\Containers\Vendor\Tenanter\Exceptions\TenantCouldNotBeIdentifiedByRequestHeaderException;

class RequestHeaderTenantResolver extends Contracts\CachedTenantResolver
{
    /**
     * The model representing the domain that the tenant was identified on.
     *
     * @var Domain
     */
    public static $currentDomain;

    /** @var bool */
    public static $shouldCache = false;

    /** @var int */
    public static $cacheTTL = 3600; // seconds

    /** @var string|null */
    public static $cacheStore = null; // default

    public function resolveWithoutCache(...$args): Tenant
    {
        $domain = $args[0];

        /** @var Tenant|null $tenant */
        $tenant = config('tenanter.models.tenant')::query()
            ->whereHas('domains', function (Builder $query) use ($domain) {
                $query->where('domain', $domain);
            })
            ->with('domains')
            ->first();

        if ($tenant) {
            $this->setCurrentDomain($tenant, $domain);

            return $tenant;
        }

        throw new TenantCouldNotBeIdentifiedByRequestHeaderException($args[0]);
    }

    public function resolved(Tenant $tenant, ...$args): void
    {
        $this->setCurrentDomain($tenant, $args[0]);
    }

    protected function setCurrentDomain(Tenant $tenant, string $domain): void
    {
        static::$currentDomain = $tenant->domains->where('domain', $domain)->first();
    }

    public function getArgsForTenant(Tenant $tenant): array
    {
        $tenant->unsetRelation('domains');

        return $tenant->domains->map(function (Domain $domain) {
            return [$domain->domain];
        })->toArray();
    }
}
