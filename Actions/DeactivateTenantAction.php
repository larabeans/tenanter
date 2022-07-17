<?php

namespace App\Containers\Larabeans\Tenanter\Actions;

use App\Containers\Larabeans\Tenanter\Tasks\UpdateTenantTask;
use App\Containers\Larabeans\Tenanter\UI\API\Requests\DeactivateTenantRequest;
use App\Ship\Parents\Actions\Action;

class DeactivateTenantAction extends Action
{
    public function run(DeactivateTenantRequest $request)
    {
        $tenant = app(UpdateTenantTask::class)->run($request->id, [
            'is_active' => false
        ]);

        return $tenant;
    }
}
