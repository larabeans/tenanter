<?php

namespace App\Containers\Larabeans\Tenanter\Events\Contracts;

use App\Ship\Parents\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Containers\Larabeans\Tenanter\Contracts\Host;

abstract class HostEvent extends Event
{
    use SerializesModels;

    /** @var Host */
    public $host;

    public Host $entity;

    public function __construct(Host $host)
    {
        $this->host = $host;
        $this->entity = $host;
    }

    /**
     * Get the channels the event should be broadcast on.
     */
    public function broadcastOn(): array
    {
        return [];
    }
}
