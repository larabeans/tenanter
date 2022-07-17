<?php

namespace App\Containers\Larabeans\Tenanter\Events;

use App\Containers\Larabeans\Tenanter\Contracts\Tenant;

class TenantCreated extends Contracts\TenantEvent
{
    public function __construct(Tenant $tenant)
    {
        parent::__construct($tenant);
    }

    public function broadcastOn(): array
    {
        return parent::broadcastOn();
    }
}
