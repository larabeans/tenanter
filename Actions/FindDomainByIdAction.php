<?php

namespace App\Containers\Larabeans\Tenanter\Actions;

use App\Containers\Larabeans\Tenanter\Models\Domain;
use App\Containers\Larabeans\Tenanter\Tasks\FindDomainTask;
use App\Containers\Larabeans\Tenanter\UI\API\Requests\FindDomainByIdRequest;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindDomainByIdAction extends Action
{
    public function run(FindDomainByIdRequest $request): Domain
    {
        return app(FindDomainTask::class)->run($request->id);
    }
}
