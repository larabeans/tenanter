<?php

namespace App\Containers\Vendor\Tenanter\Resolvers;

use Illuminate\Database\Eloquent\Builder;
use App\Containers\Vendor\Tenanter\Contracts\Domain;
use App\Containers\Vendor\Tenanter\Contracts\Tenant;
use App\Containers\Vendor\Tenanter\Exceptions\TenantCouldNotBeIdentifiedOnDomainException;

class DomainTenantResolver extends Contracts\CachedTenantResolver
{
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

        throw new TenantCouldNotBeIdentifiedOnDomainException($args[0]);
    }

    public function resolved(Tenant $tenant, ...$args): void
    {
        $this->setCurrentDomain($tenant, $args[0]);
    }

    protected function setCurrentDomain(Tenant $tenant, string $domain): void
    {
        tenancy()->domain = $tenant->domains->where('domain', $domain)->first();
    }

    public function getArgsForTenant(Tenant $tenant): array
    {
        $tenant->unsetRelation('domains');

        return $tenant->domains->map(function (Domain $domain) {
            return [$domain->domain];
        })->toArray();
    }
}
