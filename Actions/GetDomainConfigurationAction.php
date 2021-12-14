<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Tasks\FindDomainByIdTask;
use App\Containers\Vendor\Tenanter\Tasks\GetConfigurationTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\GetDomainConfigurationRequest;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetDomainConfigurationAction extends Action
{
    public function run(GetDomainConfigurationRequest $request)
    {
        $domain = app(FindDomainByIdTask::class)->run($request->header('Axis-Host'));
        return app(GetConfigurationTask::class)->run($domain->id,'domain');
    }
}
