<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Models\Tenant;
use App\Ship\Parents\Actions\Action;
use App\Containers\Vendor\Tenanter\Tasks\CreateTenantTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\CreateTenantRequest;


class CreateTenantAction extends Action
{
    public function run(CreateTenantRequest $request) : Tenant
    {
        return app(CreateTenantTask::class)->run(null, $request->name, $request->is_active,$request->domain,$request->configuration);
    }
}
