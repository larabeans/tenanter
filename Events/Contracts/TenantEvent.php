<?php

namespace App\Containers\Vendor\Tenanter\Events\Contracts;

use App\Ship\Parents\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Containers\Vendor\Tenanter\Contracts\Tenant;

abstract class TenantEvent extends Event
{
    use SerializesModels;

    /** @var Tenant */
    public $tenant;

    public Tenant $entity;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
        $this->entity = $tenant;
    }

    /**
     * Get the channels the event should be broadcast on.
     */
    public function broadcastOn(): array
    {
        return [];
    }
}
