<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Tasks\DeleteDomainTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\DeleteDomainRequest;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteDomainAction extends Action
{
    public function run(DeleteDomainRequest $request)
    {
        return app(DeleteDomainTask::class)->run($request->id);
    }
}
