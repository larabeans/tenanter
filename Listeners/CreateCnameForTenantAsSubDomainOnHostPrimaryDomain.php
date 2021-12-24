<?php

namespace App\Containers\Vendor\Tenanter\Listeners;

use App\Containers\Vendor\Tenanter\Events\TenantCreated;
use App\Containers\Vendor\Tenanter\Tasks\CreateDomainTask;
use Illuminate\Database\Eloquent\Builder;

class CreateCnameForTenantAsSubDomainOnHostPrimaryDomain
{
    public function __construct()
    {
    }

    public function handle(TenantCreated $event)
    {
        app(CreateDomainTask::class)->run(
            $this->cname(),
            true,
            'tenant',
            $event->tenant->id
        );
    }


    private function cname($name)
    {
        return $name . '.' . $this->getHostPrimaryDomains()[0];
    }

    private function getHostPrimaryDomains()
    {
        /** @var Host|null $host */
        $host = config('tenanter.models.host')::query()
            ->whereHas('domains', function (Builder $query) {
                $query->where('is_primary', true);
            })
            ->with('domains')
            ->first();

        return $host->domains();
    }
}
