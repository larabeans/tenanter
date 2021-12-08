<?php

namespace App\Containers\Vendor\Tenanter\Providers;

use Illuminate\Database\Events\MigrationsEnded;
use App\Ship\Parents\Providers\EventsProvider;
use App\Containers\Vendor\Tenanter\Events;
use App\Containers\Vendor\Tenanter\Listeners;
# use App\Containers\Vendor\Tenanter\Jobs;

class EventsServiceProvider extends EventsProvider
{

    /**
     * The event listener mappings for the application.
     *
     *
     * @var array
     */
    protected $listen = [
        // Migration events
        MigrationsEnded::class => [
            Listeners\EnsureTenantColumnExistence::class,
            Listeners\UpdateRoleTableToChangeUniqueIndex::class
        ],

        // Tenant events
        Events\CreatingTenant::class => [],
        Events\TenantCreated::class => [],
        Events\SavingTenant::class => [],
        Events\TenantSaved::class => [],
        Events\UpdatingTenant::class => [],
        Events\TenantUpdated::class => [],
        Events\DeletingTenant::class => [],
        Events\TenantDeleted::class => [],

        // Domain events
        Events\CreatingDomain::class => [],
        Events\DomainCreated::class => [],
        Events\SavingDomain::class => [],
        Events\DomainSaved::class => [],
        Events\UpdatingDomain::class => [],
        Events\DomainUpdated::class => [],
        Events\DeletingDomain::class => [],
        Events\DomainDeleted::class => [],

        // Database events
        Events\DatabaseCreated::class => [],
        Events\DatabaseMigrated::class => [],
        Events\DatabaseSeeded::class => [],
        Events\DatabaseRolledBack::class => [],
        Events\DatabaseDeleted::class => [],

        // Tenancy events
        Events\InitializingTenancy::class => [],
        Events\TenancyInitialized::class => [
            Listeners\BootstrapTenancy::class,
        ],

        Events\EndingTenancy::class => [],
        Events\TenancyEnded::class => [
            Listeners\RevertToCentralContext::class,
        ],

        Events\BootstrappingTenancy::class => [],
        Events\TenancyBootstrapped::class => [],
        Events\RevertingToCentralContext::class => [],
        Events\RevertedToCentralContext::class => [],
    ];


    public function register(): void
    {
        parent::register();
    }

    public function boot(): void
    {
        parent::boot();
    }
}
