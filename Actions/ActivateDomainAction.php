<?php

namespace App\Containers\Larabeans\Tenanter\Actions;

use App\Containers\Larabeans\Tenanter\Models\Domain;
use App\Containers\Larabeans\Tenanter\Tasks\UpdateDomainTask;
use App\Containers\Larabeans\Tenanter\UI\API\Requests\ActivateDomainRequest;
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
