<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Models\Tenant;
use App\Containers\Vendor\Tenanter\Tasks\FindTenantByIdTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\FindTenantByIdRequest;
use App\Ship\Parents\Actions\Action;

class FindTenantByIdAction extends Action
{
    public function run(FindTenantByIdRequest $request): Tenant
    {
        $tenant = app(FindTenantByIdTask::class)->run($request->id);

        return $tenant;
    }
}
