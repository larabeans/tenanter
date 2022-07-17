<?php

namespace App\Containers\Larabeans\Tenanter\Actions;

use App\Containers\Larabeans\Tenanter\Tasks\GetAllTenantsTask;
use App\Containers\Larabeans\Tenanter\UI\API\Requests\GetAllTenantsRequest;
use App\Ship\Parents\Actions\Action;

class GetAllTenantsAction extends Action
{
    public function run(GetAllTenantsRequest $request): object
    {
        $tenants = app(GetAllTenantsTask::class)->addRequestCriteria()->run();

        return $tenants;
    }
}
