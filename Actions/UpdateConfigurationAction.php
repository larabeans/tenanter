<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Configurationer\Models\Configuration;
use App\Containers\Vendor\Tenanter\Tasks\UpdateConfigurationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateConfigurationAction extends Action
{
    public function run(Request $request)
    {
        $data = [
            'configuration' => json_encode($request->configuration)
        ];
        return app(UpdateConfigurationTask::class)->run($data, $request->type, $request->header('Axis-Host'));
    }
}
