<?php

namespace App\Containers\Vendor\Tenanter\Listeners;

use App\Containers\Vendor\Tenanter\Events\TenantCreated;
use App\Containers\Vendor\Tenanter\Tasks\CreateDomainTask;

class CreateCnameForTenantAsSubDomainOnHostPrimaryDomain
{
    public function __construct()
    {
    }

    public function handle(TenantCreated $event)
    {
        // TODO: Get Primary Host Domain, and create subdomain to be used as cname for tenant,
        // pass that instead of tenant name
        $cname = '';
        app(CreateDomainTask::class)->run($cname, true, 'tenant', $event->tenant->id);
    }


    private function createCname($name) {
        // TODO: Get host primary domain, attache tenant-name to create cname for new tenant
        $hostDomain = config('tenanter.host_domains');

        return $name . '.' . $hostDomain[1];
    }
}
