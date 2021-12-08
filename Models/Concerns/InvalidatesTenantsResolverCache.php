<?php

namespace App\Containers\Vendor\Tenanter\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use App\Containers\Vendor\Tenanter\Resolvers;
use App\Containers\Vendor\Tenanter\Resolvers\Contracts\CachedTenantResolver;

/**
 * Meant to be used on models that belong to tenants.
 */
trait InvalidatesTenantsResolverCache
{
    public static $resolvers = [
        Resolvers\DomainTenantTenantResolver::class,
        Resolvers\PathTenantResolver::class,
        Resolvers\RequestDataTenantResolver::class,
    ];

    public static function bootInvalidatesTenantsResolverCache()
    {
        static::saved(function (Model $model) {
            foreach (static::$resolvers as $resolver) {
                /** @var CachedTenantResolver $resolver */
                $resolver = app($resolver);

                $resolver->invalidateCache($model->tenant);
            }
        });
    }
}
