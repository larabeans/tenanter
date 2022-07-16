<?php

namespace App\Containers\Larabeans\Tenanter\Actions;

use App\Containers\Larabeans\Tenanter\Tasks\UpdateTenantTask;
use App\Containers\Larabeans\Tenanter\UI\API\Requests\UpdateTenantRequest;
use App\Ship\Parents\Actions\Action;

class UpdateTenantAction extends Action
{
    public function run(UpdateTenantRequest $request)
    {
        //TODO WIP
        $data = $request->sanitizeInput([

        ]);

        $tenant = app(UpdateTenantTask::class)->run($request->id, $data);

        return $tenant;
    }
}
