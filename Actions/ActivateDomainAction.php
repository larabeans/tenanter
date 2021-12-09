<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Models\Domain;
use App\Containers\Vendor\Tenanter\Tasks\UpdateDomainTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\ActivateDomainRequest;
use App\Ship\Parents\Actions\Action;

class ActivateDomainAction extends Action
{
    public function run(ActivateDomainRequest $request): Domain
    {
        return app(UpdateDomainTask::class)->run($request->id, [
            'is_active' => true
        ]);
    }
}
