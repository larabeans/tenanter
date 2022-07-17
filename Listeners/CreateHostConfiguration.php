<?php

namespace App\Containers\Larabeans\Tenanter\Listeners;

use App\Containers\Larabeans\Configurationer\Configurationer;
use App\Containers\Larabeans\Tenanter\Events\HostCreated;
use App\Containers\Larabeans\Tenanter\Tasks\CreateConfigurationTask;


class CreateHostConfiguration
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
     * @param \App\Events\HostCreated $event
     * @return void
     */
    public function handle(HostCreated $event)
    {
        app(CreateConfigurationTask::class)->run([
            'configurable_type' => 'host',
            'configuration' => configurationer()::getDefault('host'),
            'id' => $event->entity->id
        ]);
    }
}
