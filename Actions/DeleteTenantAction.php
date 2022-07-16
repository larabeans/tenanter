<?php

namespace App\Containers\Larabeans\Tenanter\Actions;

use App\Containers\Larabeans\Tenanter\Tasks\DeleteTenantTask;
use App\Containers\Larabeans\Tenanter\UI\API\Requests\DeleteTenantRequest;
use App\Ship\Parents\Actions\Action;

class DeleteTenantAction extends Action
{
    public function run(DeleteTenantRequest $request)
    {
        return app(DeleteTenantTask::class)->run($request->id);
    }
}
