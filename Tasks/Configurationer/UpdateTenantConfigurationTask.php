<?php

namespace App\Containers\Larabeans\Tenanter\Tasks\Configurationer;

use App\Containers\Larabeans\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Larabeans\Tenanter\Contracts\Tenant;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Requests\Request;
use App\Ship\Parents\Tasks\Task;

class UpdateTenantConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Request $request, $configuration, $key, $id)
    {
        try {

            $configurable = $configuration -> configurable;

            if($configurable instanceof Tenant && $configurable->id === tenant()->getTenantKey() && tenancy()->isValidTenantAdmin()) {

                // Update Configurations
                $data = [
                    'configuration' => json_encode($request->configuration)
                ];

                $configurations = $this->repository->update($data, $id);

                $configurations->configuration = json_decode($configurations->configuration);

                return $configurations;
            }

        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }

    }
}
