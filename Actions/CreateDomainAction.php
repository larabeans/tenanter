<?php

namespace App\Containers\Larabeans\Tenanter\Actions;

use App\Containers\Larabeans\Tenanter\Models\Domain;
use App\Containers\Larabeans\Tenanter\Tasks\CreateDomainTask;
use App\Containers\Larabeans\Tenanter\UI\API\Requests\CreateDomainRequest;
use App\Ship\Parents\Actions\Action;

class CreateDomainAction extends Action
{
    public function run(CreateDomainRequest $request):Domain
    {
        return app(CreateDomainTask::class)->run(
            $request->domain,
            false,
            'tenant',
            tenant()->getTenantKey()
        );
    }
}
