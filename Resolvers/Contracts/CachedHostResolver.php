<?php

namespace App\Containers\Vendor\Tenanter\Resolvers\Contracts;

use Illuminate\Contracts\Cache\Factory;
use Illuminate\Contracts\Cache\Repository;
use App\Containers\Vendor\Tenanter\Contracts\Host;
use App\Containers\Vendor\Tenanter\Contracts\HostResolver;

abstract class CachedHostResolver implements HostResolver
{
    /** @var bool */
    public static $shouldCache = false;

    /** @var int */
    public static $cacheTTL = 3600; // seconds

    /** @var string|null */
    public static $cacheStore = null; // default

    /** @var Repository */
    protected $cache;

    public function __construct(Factory $cache)
    {
        $this->cache = $cache->store(static::$cacheStore);
    }

    public function resolve(...$args): ?Host
    {
        if (! static::$shouldCache) {
            return $this->resolveWithoutCache(...$args);
        }

        $key = $this->getCacheKey(...$args);

        if ($this->cache->has($key)) {
            $host = $this->cache->get($key);

            $this->resolved($host, ...$args);

            return $host;
        }

        $host = $this->resolveWithoutCache(...$args);
        $this->cache->put($key, $host, static::$cacheTTL);

        return $host;
    }

    public function invalidateCache(Host $host): void
    {
        if (! static::$shouldCache) {
            return;
        }

        foreach ($this->getArgsForHost($host) as $args) {
            $this->cache->forget($this->getCacheKey(...$args));
        }
    }

    public function getCacheKey(...$args): string
    {
        return '_tenancy_resolver:' . static::class . ':' . json_encode($args);
    }

    abstract public function resolveWithoutCache(...$args): ?Host;

    public function resolved(Host $host, ...$args): void
    {
    }

    /**
     * Get all the arg combinations for resolve() that can be used to find this tenant.
     *
     * @param Host $host
     * @return array[]
     */
    abstract public function getArgsForHost(Host $host): array;
}
