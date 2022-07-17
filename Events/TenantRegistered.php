<?php

namespace App\Containers\Larabeans\Tenanter\Events;

use App\Ship\Parents\Events\Event;
use App\Containers\Larabeans\Tenanter\Models\Tenant;
use Illuminate\Queue\SerializesModels;

class TenantRegistered extends Event
{
    use SerializesModels;

    public Tenant $entity;

    /**
     * TenantRegistered constructor.
     *
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    /**
     * Get the channels the event should be broadcast on.
     */
    public function broadcastOn(): array
    {
        return [];
    }
}
