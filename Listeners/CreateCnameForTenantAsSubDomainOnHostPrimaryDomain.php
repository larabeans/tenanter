<?php

namespace App\Containers\Vendor\Tenanter\Listeners;

use App\Containers\Vendor\Tenanter\Events\TenantCreated;
use App\Containers\Vendor\Tenanter\Tasks\CreateCnameForTenantAsSubDomainOnHostPrimaryDomainTask;

class CreateCnameForTenantAsSubDomainOnHostPrimaryDomain
{
    public function __construct()
    {
    }

    public function handle(TenantCreated $event)
    {
        app(CreateCnameForTenantAsSubDomainOnHostPrimaryDomainTask::class)->run($event->tenant->name, 'tenant', $event->tenant->id);
    }
}
