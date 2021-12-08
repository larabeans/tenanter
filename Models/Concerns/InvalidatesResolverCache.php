<?php

namespace App\Containers\Vendor\Tenanter\Models\Concerns;

use App\Containers\Vendor\Tenanter\Contracts\Tenant;
use App\Containers\Vendor\Tenanter\Resolvers;
use App\Containers\Vendor\Tenanter\Resolvers\Contracts\CachedTenantResolver;

trait InvalidatesResolverCache
{
    public static $resolvers = [
        Resolvers\DomainTenantTenantResolver::class,
        Resolvers\PathTenantResolver::class,
        Resolvers\RequestDataTenantResolver::class,
    ];

    public static function bootInvalidatesResolverCache()
    {
        static::saved(function (Tenant $tenant) {
            foreach (static::$resolvers as $resolver) {
                /** @var CachedTenantResolver $resolver */
                $resolver = app($resolver);

                $resolver->invalidateCache($tenant);
            }
        });
    }
}
