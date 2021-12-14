<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Models\Configuration;
use App\Containers\Vendor\Tenanter\Tasks\GetConfigurationTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\GetTenantConfigurationRequest;
use App\Ship\Parents\Actions\Action;

class GetTenantConfigurationAction extends Action
{
    public function run(GetTenantConfigurationRequest $request)
    {

        return app(GetConfigurationTask::class)->run(tenant()->getKey(), 'tenant');
    }
}
