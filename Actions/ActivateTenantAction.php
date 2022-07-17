<?php

namespace App\Containers\Larabeans\Tenanter\Actions;

use App\Containers\Larabeans\Tenanter\UI\API\Requests\ActivateTenantRequest;
use App\Ship\Parents\Actions\Action;
use App\Containers\Larabeans\Tenanter\Models\Tenant;
use App\Containers\Larabeans\Tenanter\Tasks\UpdateTenantTask;

class ActivateTenantAction extends Action
{
    public function run(ActivateTenantRequest $request): Tenant
    {
        $tenant = app(UpdateTenantTask::class)->run($request->id, [
            'is_active' => true
        ]);

        return $tenant;
    }
}
