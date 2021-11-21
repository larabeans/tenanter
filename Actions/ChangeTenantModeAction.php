<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Models\Tenant;
use App\Containers\Vendor\Tenanter\Tasks\UpdateTenantTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\ChangeTenantModeRequest;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class ChangeTenantModeAction extends Action
{
    public function run(ChangeTenantModeRequest $request): Tenant
    {
        $data = $request->sanitizeInput([
            'mode'
        ]);

        return app(UpdateTenantTask::class)->run($request->id, $data);
    }
}
