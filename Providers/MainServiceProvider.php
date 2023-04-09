<?php

namespace App\Containers\Larabeans\Tenanter\Providers;

use App\Containers\Larabeans\Configurationer\Configurationer;
use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;
use App\Containers\Larabeans\Tenanter\Models\Tenant;


/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends ParentMainServiceProvider
{
    /**
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [
        TenancyServiceProvider::class,
        MiddlewareServiceProvider::class,
        EventsServiceProvider::class
    ];


    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [
        // 'Foo' => Bar::class,
    ];

    /**
     * Register anything in the container.
     */
    public function register(): void
    {
        parent::register();
    }

    /**
     * Boot anything in the container.
     */
    public function boot(): void
    {
        parent::boot();
        if (config('configurationer.installed')) {
            configurationer()::addSystemConfiguration('tenancy', config('tenanter.configurationer.tenancy', []));
            configurationer()::addEntity(config('tenanter.configurationer.entities'), 'system');
        }
    }
}
