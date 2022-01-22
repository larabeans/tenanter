<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Models\Domain;
use App\Containers\Vendor\Tenanter\Tasks\UpdateDomainTask;
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
