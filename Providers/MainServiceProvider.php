<?php

namespace App\Containers\Vendor\Tenanter\Providers;

use App\Ship\Parents\Providers\MainProvider;
use App\Containers\Vendor\Tenanter\Models\Tenant;


/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends MainProvider
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
        configurationer()::addSystemConfiguration('tenancy', config('tenanter.tenancy', []));
        configurationer()::addEntity(config('tenanter.configurable'));
    }
}
