<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Models\Tenant;
use App\Containers\Vendor\Tenanter\Tasks\FindTenantByDomainTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Vendor\Tenanter\UI\API\Requests\FindTenantByDomainRequest;

class FindTenantByDomainAction extends Action
{
    public function run(FindTenantByDomainRequest $request)
    {
        return app(FindTenantByDomainTask::class)->run($request->domain);
    }
}
