<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Models\Domain;
use App\Containers\Vendor\Tenanter\Tasks\FindDomainByIdTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\FindDomainByIdRequest;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindDomainByIdAction extends Action
{
    public function run(FindDomainByIdRequest $request): Domain
    {
        return app(FindDomainByIdTask::class)->run($request->id);
    }
}