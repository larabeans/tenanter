<?php

namespace App\Containers\Larabeans\Tenanter\Providers;

use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;
use App\Containers\Larabeans\Tenanter\Tenancy;
use App\Containers\Larabeans\Tenanter\Contracts\Host;
use App\Containers\Larabeans\Tenanter\Contracts\Tenant;
use App\Containers\Larabeans\Tenanter\Contracts\Domain;
use App\Containers\Larabeans\Tenanter\Bootstrappers\FilesystemTenancyBootstrapper;

class TenancyServiceProvider extends ParentMainServiceProvider
{

    public function register():void
    {
        parent::register();

        // Stateful Bootstrappers ( i.e. singletons)
        $this->app->singleton(Tenancy::class);

        // Make sure features are bootstrapped as soon as Tenancy is instantiated.
        $this->app->extend(Tenancy::class, function (Tenancy $tenancy) {
            foreach ($this->app['config']['tenanter.features'] ?? [] as $feature) {
                $this->app[$feature]->bootstrap($tenancy);
            }
            return $tenancy;
        });

        // Bind with resolved host
        $this->app->bind(Host::class, function ($app) {
            return $app[Tenancy::class]->host;
        });

        // Bind with resolved tenant
        $this->app->bind(Tenant::class, function ($app) {
            return $app[Tenancy::class]->tenant;
        });

        // Bind with resolved domain
        $this->app->bind(Domain::class, function ($app) {
            return $app[Tenancy::class]->domain;
        });

        // Stateful Bootstrappers ( i.e. singletons)
        foreach ($this->app['config']['tenanter.bootstrappers'] ?? [] as $bootstrapper) {
            if (method_exists($bootstrapper, '__constructStatic')) {
                $bootstrapper::__constructStatic($this->app);
            }

            $this->app->singleton($bootstrapper);
        }

        $this->app->bind('globalCache', function ($app) {
            return new CacheManager($app);
        });
    }

    public function boot() : void
    {
        parent::boot();

        $this->app->singleton('globalUrl', function ($app) {
            if ($app->bound(FilesystemTenancyBootstrapper::class)) {
                $instance = clone $app['url'];
                $instance->setAssetRoot($app[FilesystemTenancyBootstrapper::class]->originalPaths['asset_url']);
            } else {
                $instance = $app['url'];
            }

            return $instance;
        });
    }

}
