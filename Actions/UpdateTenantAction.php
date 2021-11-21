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
            'name',
            'domain'
        ]);

        $tenant = app(UpdateTenantTask::class)->run($request->id, $data);

        return $tenant;
    }
}
