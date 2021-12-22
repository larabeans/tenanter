<?php

namespace App\Containers\Vendor\Tenanter\Listeners;

use App\Containers\Vendor\Tenanter\Events\TenantCreated;
use App\Containers\Vendor\Tenanter\Tasks\CreateTenantConfigurationTask;


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
        app(CreateTenantConfigurationTask::class)->run([
            'configurable_type' => 'tenant',
            'configuration' => config('configurationer.default'),
            'tenant_id' => $event->tenant->id
        ]);
    }
}