<?php

namespace App\Containers\Vendor\Tenanter\Providers;

use App\Containers\Vendor\Tenanter\Listeners\CheckForTenantColumnForUpdatedTable;
use App\Containers\Vendor\Tenanter\Listeners\AuthenticatedListener;
use App\Ship\Parents\Providers\MainProvider;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Database\Events\MigrationEnded;
use Illuminate\Support\Facades\Event;

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
        // InternalServiceProviderExample::class,
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

        Event::listen(MigrationEnded::class, [
            CheckForTenantColumnForUpdatedTable::class, "handle"
        ]);

        // listener in not working
        Event::listen(Authenticated::class, [
            AuthenticatedListener::class, 'handle',
        ]);

    }
}
