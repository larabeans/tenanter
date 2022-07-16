<?php

namespace App\Containers\Larabeans\Tenanter\Actions;

use App\Containers\Larabeans\Tenanter\Models\Domain;
use App\Containers\Larabeans\Tenanter\Tasks\UpdateDomainTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeactivateDomainAction extends Action
{
    public function run(Request $request): Domain
    {
        return app(UpdateDomainTask::class)->run($request->id, [
            'is_active' => false
        ]);
    }
}
