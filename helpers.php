<?php

use App\Containers\Larabeans\Tenanter\Contracts\Host;
use App\Containers\Larabeans\Tenanter\Contracts\Tenant;
use App\Containers\Larabeans\Tenanter\Contracts\Domain;
use App\Containers\Larabeans\Tenanter\Tenancy;

if (! function_exists('tenancy')) {
    /** @return Tenancy */
    function tenancy()
    {
        return app(Tenancy::class);
    }
}

if (! function_exists('host')) {
    /**
     * Get a key from the current host's storage.
     *
     * @param string|null $key
     * @return Host|null|mixed
     */
    function host($key = null)
    {
        if (! app()->bound(Host::class)) {
            return;
        }

        if (is_null($key)) {
            return app(Host::class);
        }

        return optional(app(Host::class))->getAttribute($key) ?? null;
    }
}

if (! function_exists('tenant')) {
    /**
     * Get a key from the current tenant's storage.
     *
     * @param string|null $key
     * @return Tenant|null|mixed
     */
    function tenant($key = null)
    {
        if (! app()->bound(Tenant::class)) {
            return;
        }

        if (is_null($key)) {
            return app(Tenant::class);
        }

        return optional(app(Tenant::class))->getAttribute($key) ?? null;
    }
}

if (! function_exists('domain')) {
    /**
     * Get a key from the current host's storage.
     *
     * @param string|null $key
     * @return Domain|null|mixed
     */

    function domain($key = null)
    {
        if (! app()->bound(Domain::class)) {
            return;
        }

        if (is_null($key)) {
            return app(Domain::class);
        }

        return optional(app(Domain::class))->getAttribute($key) ?? null;
    }
}

if (! function_exists('tenant_asset')) {
    /** @return string */
    function tenant_asset($asset)
    {
        return app('url')->asset($asset);
    }
}

if (! function_exists('global_asset')) {
    function global_asset($asset)
    {
        return app('globalUrl')->asset($asset);
    }
}

if (! function_exists('global_cache')) {
    function global_cache()
    {
        return app('globalCache');
    }
}

if (! function_exists('tenant_route')) {
    function tenant_route(string $domain, $route, $parameters = [], $absolute = true)
    {
        // replace first occurance of hostname fragment with $domain
        $url = route($route, $parameters, $absolute);
        $hostname = parse_url($url, PHP_URL_HOST);
        $position = strpos($url, $hostname);

        return substr_replace($url, $domain, $position, strlen($hostname));
    }
}
