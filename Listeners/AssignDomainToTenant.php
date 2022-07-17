<?php

namespace App\Containers\Larabeans\Tenanter\Listeners;

use App\Containers\Larabeans\Tenanter\Events\TenantCreated;
use App\Containers\Larabeans\Tenanter\Tasks\AssignDomainToTenantTask;

class AssignDomainToTenant
{
    public function __construct()
    {
    }

    public function handle(TenantCreated $event)
    {
         app(AssignDomainToTenantTask::class)->run($event->tenant,false, $event->tenant->id,'tenant');
    }
}
