<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Models\Tenant;
use App\Containers\Vendor\Tenanter\Tasks\FindTenantByIdOrDomainNameTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Vendor\Tenanter\UI\API\Requests\FindTenantByIdOrDomainNameRequest;

class FindTenantByIdOrDomainNameAction extends Action
{
    public function run(FindTenantByIdOrDomainNameRequest $request)
    {
        return app(FindTenantByIdOrDomainNameTask::class)->run($request->id);
    }
}
