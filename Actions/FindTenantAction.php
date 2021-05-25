<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Models\Tenant;
use App\Containers\Vendor\Tenanter\Tasks\FindTenantTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\FindTenantByIdRequest;
use App\Ship\Parents\Actions\Action;

class FindTenantAction extends Action
{
    public function run(FindTenantByIdRequest $request): Tenant
    {
        $tenant = app(FindTenantTask::class)->run($request->id);

        return $tenant;
    }
}
