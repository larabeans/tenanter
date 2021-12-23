<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Models\Domain;
use App\Containers\Vendor\Tenanter\Tasks\CreateDomainTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\CreateDomainRequest;
use App\Ship\Parents\Actions\Action;

class CreateDomainAction extends Action
{
    public function run(CreateDomainRequest $request):Domain
    {
        return app(CreateDomainTask::class)->run(
            $request->domain,
            'tenant',
            tenant()->getTenantKey()
        );
    }
}
