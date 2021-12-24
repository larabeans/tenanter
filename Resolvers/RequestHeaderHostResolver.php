<?php

namespace App\Containers\Vendor\Tenanter\Resolvers;

use Illuminate\Database\Eloquent\Builder;
use App\Containers\Vendor\Tenanter\Tenancy;
use App\Containers\Vendor\Tenanter\Contracts\Domain;
use App\Containers\Vendor\Tenanter\Contracts\Host;
use App\Containers\Vendor\Tenanter\Exceptions\HostCouldNotBeIdentifiedByRequestHeaderException;

class RequestHeaderHostResolver extends Contracts\CachedHostResolver
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

    public function resolveWithoutCache(...$args): Host
    {
        $domain = $args[0];

        /** @var Host|null $host */
        $host = config('tenanter.models.host')::query()
            ->whereHas('domains', function (Builder $query) use ($domain) {
                $query->where('domain', $domain);
            })
            ->with('domains')
            ->first();

        if ($host) {
            $this->setCurrentDomain($host, $domain);

            return $host;
        }

        throw new HostCouldNotBeIdentifiedByRequestHeaderException($args[0]);
    }

    public function resolved(Host $host, ...$args): void
    {
        $this->setCurrentDomain($host, $args[0]);
    }

    protected function setCurrentDomain(Host $host, string $domain): void
    {
        static::$currentDomain = $host->domains->where('domain', $domain)->first();
        Tenancy::$currentDomain = static::$currentDomain;
    }

    public function getArgsForHost(Host $host): array
    {
        $host->unsetRelation('domains');

        return $host->domains->map(function (Domain $domain) {
            return [$domain->domain];
        })->toArray();
    }
}
