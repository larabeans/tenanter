<?php

namespace App\Containers\Vendor\Tenanter\Listeners;

use App\Containers\Vendor\Tenanter\Events\TenantCreated;
use App\Containers\Vendor\Tenanter\Tasks\CreateDomainTask;
use App\Containers\Vendor\Tenanter\Tasks\GetHostPrimaryDomainsTask;
use Illuminate\Database\Eloquent\Builder;

class CreateCnameForTenantAsSubDomainOnHostPrimaryDomain
{
    public function __construct()
    {
    }

    public function handle(TenantCreated $event)
    {
        $domain = app(GetHostPrimaryDomainsTask::class)
                    ->run()
                    ->pluck('domain')
                    ->toArray()[0];

        $cname  = $event->tenant->slug . '.' . str_replace('www.', '', $domain);

        app(CreateDomainTask::class)->run(
            $cname,
            true,
            'tenant',
            $event->tenant->id
        );
    }
}
