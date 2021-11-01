<?php

namespace App\Containers\Vendor\Tenanter\Events;

use App\Ship\Parents\Events\Event;
use App\Containers\Vendor\Tenanter\Models\Tenant;
use Illuminate\Queue\SerializesModels;

class TenantRegisteredEvent extends Event
{
    use SerializesModels;

    public Tenant $entity;

    /**
     * TenantRegisteredEvent constructor.
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
