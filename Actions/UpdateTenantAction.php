<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Tasks\UpdateTenantTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\UpdateTenantRequest;
use App\Ship\Parents\Actions\Action;

class UpdateTenantAction extends Action
{
    public function run(UpdateTenantRequest $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $tenant = app(UpdateTenantTask::class)->run($request->id, [
            'name' => $request->name,
            'is_active' => $request->status,
            'configuration'=> json_encode($request->configuration)
        ]);

        return $tenant;
    }
}
