<?php

namespace App\Containers\Vendor\Tenanter\Listeners;

use App\Containers\Vendor\Configurationer\Configurationer;
use App\Containers\Vendor\Tenanter\Events\DomainCreated;
use App\Containers\Vendor\Tenanter\Tasks\CreateConfigurationTask;

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
        app(CreateConfigurationTask::class)->run([
            'configurable_type' => 'domain',
            'configuration' => configurationer()::getDefault('domain'),
            'id' => $event->domain->id
        ]);
    }
}
