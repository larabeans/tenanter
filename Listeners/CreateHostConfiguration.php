<?php

namespace App\Containers\Larabeans\Tenanter\Listeners;

use App\Containers\Larabeans\Tenanter\Events\HostCreated;
use App\Containers\Larabeans\Configurationer\Tasks\CreateConfigurationTask;


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
            'configurable_id' => $event->entity->id,
            'configuration' => configurationer()::getDefault('host'),
        ]);
    }
}
