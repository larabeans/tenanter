<?php

namespace App\Containers\Larabeans\Tenanter\Actions;

use App\Containers\Larabeans\Tenanter\Models\Tenant;
use App\Containers\Larabeans\Tenanter\Tasks\CreateTenantTask;
use App\Ship\Parents\Actions\Action;
use App\Containers\Larabeans\Tenanter\UI\API\Requests\CreateTenantRequest;

class CreateTenantAction extends Action
{
    public function run(CreateTenantRequest $request): Tenant
    {
        $tenant = app(CreateTenantTask::class)->run(null, $request->name, $request->is_active, $request->mode);

        return $tenant;
    }
}
