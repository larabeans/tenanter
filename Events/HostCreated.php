<?php

namespace App\Containers\Larabeans\Tenanter\Events;

use App\Containers\Larabeans\Tenanter\Contracts\Host;

class HostCreated extends Contracts\HostEvent
{
    public function __construct(Host $host)
    {
        parent::__construct($host);
    }

    public function broadcastOn(): array
    {
        return parent::broadcastOn();
    }
}
