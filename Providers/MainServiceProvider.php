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

        // Feed configurations to global container
        $targetConfigurableTypes = config('configurationer.entities');
        $sourceConfigurableTypes = config('tenanter.configurable_entities');
        $configurableTypes       = array_merge($targetConfigurableTypes, $sourceConfigurableTypes);
        config(['configurationer.entities' => $configurableTypes]);
        config(['configurationer.system.tenancy' => config('tenanter.tenancy', [])]);

    }
}
