<?php

namespace App\Containers\Vendor\Tenanter\Events;

use App\Containers\Vendor\Tenanter\Contracts\Tenant;

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
