<?php

namespace App\Containers\Vendor\Tenanter\Listeners;

use App\Containers\Vendor\Configurationer\Configurationer;
use App\Containers\Vendor\Tenanter\Events\TenantCreated;
use App\Containers\Vendor\Tenanter\Tasks\CreateConfigurationTask;


class CreateTenantConfiguration
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
     * @param \App\Events\TenantCreated $event
     * @return void
     */
    public function handle(TenantCreated $event)
    {
        app(CreateConfigurationTask::class)->run([
            'configurable_type' => 'tenant',
            'configuration' => configurationer()::getDefault('tenant'),
            'id' => $event->tenant->id
        ]);
    }
}
