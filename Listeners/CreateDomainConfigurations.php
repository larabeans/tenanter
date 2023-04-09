<?php

namespace App\Containers\Larabeans\Tenanter\Listeners;

use App\Containers\Larabeans\Tenanter\Events\DomainCreated;
use App\Containers\Larabeans\Configurationer\Tasks\CreateConfigurationTask;

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
            'configurable_id' => $event->domain->id,
            'configuration' => configurationer()::getDefault('domain')
        ]);
    }
}
