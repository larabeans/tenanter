<?php

namespace App\Containers\Larabeans\Tenanter\Resolvers;

use Illuminate\Database\Eloquent\Builder;
use App\Containers\Larabeans\Tenanter\Tenancy;
use App\Containers\Larabeans\Tenanter\Contracts\Domain;
use App\Containers\Larabeans\Tenanter\Contracts\Host;
use App\Containers\Larabeans\Tenanter\Exceptions\HostCouldNotBeIdentifiedByRequestHeaderException;

class RequestHeaderHostResolver extends Contracts\CachedHostResolver
{
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

        // throw new HostCouldNotBeIdentifiedByRequestHeaderException($args[0]);
    }

    public function resolved(Host $host, ...$args): void
    {
        $this->setCurrentDomain($host, $args[0]);
    }

    protected function setCurrentDomain(Host $host, string $domain): void
    {
        tenancy()->domain = $host->domains->where('domain', $domain)->first();
    }

    public function getArgsForHost(Host $host): array
    {
        $host->unsetRelation('domains');

        return $host->domains->map(function (Domain $domain) {
            return [$domain->domain];
        })->toArray();
    }
}
