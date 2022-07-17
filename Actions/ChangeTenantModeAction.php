<?php

namespace App\Containers\Larabeans\Tenanter\Actions;

use App\Containers\Larabeans\Tenanter\Models\Tenant;
use App\Containers\Larabeans\Tenanter\Tasks\UpdateTenantTask;
use App\Containers\Larabeans\Tenanter\UI\API\Requests\ChangeTenantModeRequest;
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
