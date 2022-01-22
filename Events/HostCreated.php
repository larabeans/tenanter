<?php

namespace App\Containers\Vendor\Tenanter\Events;

use App\Containers\Vendor\Tenanter\Contracts\Host;

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
