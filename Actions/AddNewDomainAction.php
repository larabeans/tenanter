<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Models\Domain;
use App\Containers\Vendor\Tenanter\Tasks\AssignDomainToTenantTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\AddNewDomainRequest;
use App\Ship\Parents\Actions\Action;

class AddNewDomainAction extends Action
{
    public function run(AddNewDomainRequest $request):Domain
    {
        return app(AssignDomainToTenantTask::class)->run($request->domain,true);
    }
}
