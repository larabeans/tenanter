<?php

namespace App\Containers\Vendor\Tenanter\Listeners;

use App\Containers\Vendor\Tenanter\Events\DomainCreated;
use App\Containers\Vendor\Tenanter\Tasks\CreateTenantConfigurationTask;

class CreateDomainConfigurations
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\DomainCreated $event
     * @return void
     */
    public function handle(DomainCreated $event)
    {
        app(CreateTenantConfigurationTask::class)->run([
            'configurable_type' => 'domain',
            'configuration' => config('configurationer.default'),
            'id' => $event->domain->id
        ]);
    }
}
