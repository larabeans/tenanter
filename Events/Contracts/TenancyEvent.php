<?php

namespace App\Containers\Vendor\Tenanter\Events\Contracts;

use App\Ship\Parents\Events\Event;
use App\Containers\Vendor\Tenanter\Tenancy;

abstract class TenancyEvent extends Event
{
    /** @var Tenancy */
    public $tenancy;

    public Tenancy $entity;

    public function __construct(Tenancy $tenancy)
    {
        $this->tenancy = $tenancy;
        $this->entity = $tenancy;
    }

    /**
     * Get the channels the event should be broadcast on.
     */
    public function broadcastOn(): array
    {
        return [];
    }
}
