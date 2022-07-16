<?php

namespace App\Containers\Larabeans\Tenanter\Actions;


use App\Containers\Larabeans\Tenanter\Tasks\GetAllTenantDomainsTask;
use App\Containers\Larabeans\Tenanter\UI\API\Requests\GetAllTenantDomainsRequest;
use App\Ship\Parents\Actions\Action;

class GetAllTenantDomainsAction extends Action
{
    public function run(GetAllTenantDomainsRequest $request)
    {
        return app(GetAllTenantDomainsTask::class)->run($request->id);
    }
}
