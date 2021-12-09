<?php

namespace App\Containers\Vendor\Tenanter\Actions;


use App\Containers\Vendor\Tenanter\Tasks\GetAllTenantDomainsTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\GetAllTenantDomainsRequest;
use App\Ship\Parents\Actions\Action;

class GetAllTenantDomainsAction extends Action
{
    public function run(GetAllTenantDomainsRequest $request)
    {
        return app(GetAllTenantDomainsTask::class)->run($request->id);
    }
}
