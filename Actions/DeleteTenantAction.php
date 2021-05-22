<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Tasks\DeleteTenantTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\DeleteTenantRequest;
use App\Ship\Parents\Actions\Action;

class DeleteTenantAction extends Action
{
    public function run(DeleteTenantRequest $request)
    {
        return app(DeleteTenantTask::class)->run($request->id);
    }
}
