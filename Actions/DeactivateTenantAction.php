<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Tasks\UpdateTenantTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\UpdateTenantRequest;
use App\Ship\Parents\Actions\Action;

class DeactivateTenantAction extends Action
{
    public function run(UpdateTenantRequest $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $tenant = app(UpdateTenantTask::class)->run($request->id, [
            'is_active' => false
        ]);

        return $tenant;
    }
}
