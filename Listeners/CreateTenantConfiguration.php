<?php

namespace App\Containers\Larabeans\Tenanter\Listeners;

use App\Containers\Larabeans\Tenanter\Events\TenantCreated;
use App\Containers\Larabeans\Configurationer\Tasks\CreateConfigurationTask;


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
            'configurable_id' => $event->tenant->id,
            'configuration' => configurationer()::getDefault('tenant'),
        ]);
    }
}
