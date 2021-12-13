<?php

namespace App\Containers\Vendor\Tenanter\Listeners;

use App\Containers\Vendor\Tenanter\Events\TenantCreated;
use App\Containers\Vendor\Tenanter\Tasks\AssignDomainToTenantTask;

class AssignDomainToTenant
{
    public function __construct()
    {
    }

    public function handle(TenantCreated $event)
    {
         app(AssignDomainToTenantTask::class)->run($event->tenant);
    }
}
