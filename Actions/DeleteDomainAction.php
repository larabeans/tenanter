<?php

namespace App\Containers\Larabeans\Tenanter\Actions;

use App\Containers\Larabeans\Tenanter\Tasks\DeleteDomainTask;
use App\Containers\Larabeans\Tenanter\UI\API\Requests\DeleteDomainRequest;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteDomainAction extends Action
{
    public function run(DeleteDomainRequest $request)
    {
        return app(DeleteDomainTask::class)->run($request->id);
    }
}
