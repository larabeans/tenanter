<?php

namespace App\Containers\Larabeans\Tenanter\Actions;

use App\Containers\Larabeans\Tenanter\Models\Tenant;
use App\Containers\Larabeans\Tenanter\Tasks\FindTenantByIdOrDomainNameTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Larabeans\Tenanter\UI\API\Requests\FindTenantByIdOrDomainNameRequest;

class FindTenantByIdOrDomainNameAction extends Action
{
    public function run(FindTenantByIdOrDomainNameRequest $request)
    {
        return app(FindTenantByIdOrDomainNameTask::class)->run($request->id);
    }
}
