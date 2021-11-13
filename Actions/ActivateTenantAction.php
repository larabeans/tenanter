<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Vendor\Tenanter\Models\Tenant;
use App\Containers\Vendor\Tenanter\UI\API\Requests\UpdateTenantRequest;
use App\Containers\Vendor\Tenanter\Tasks\UpdateTenantTask;

class ActivateTenantAction extends Action
{
    public function run(UpdateTenantRequest $request): Tenant
    {
        $tenant = app(UpdateTenantTask::class)->run($request->id, [
            'is_active' => true
        ]);

        return $tenant;
    }
}
