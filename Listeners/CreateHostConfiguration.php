<?php

namespace App\Containers\Vendor\Tenanter\Listeners;

use App\Containers\Vendor\Tenanter\Events\HostCreated;
use App\Containers\Vendor\Tenanter\Tasks\CreateConfigurationTask;


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
