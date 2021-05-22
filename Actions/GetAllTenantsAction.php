<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Tasks\GetAllTenantsTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\GetAllTenantsRequest;
use App\Ship\Parents\Actions\Action;

class GetAllTenantsAction extends Action
{
    public function run(GetAllTenantsRequest $request) : array
    {
        $tenants = app(GetAllTenantsTask::class)->addRequestCriteria()->run();

        return $tenants;
    }
}
