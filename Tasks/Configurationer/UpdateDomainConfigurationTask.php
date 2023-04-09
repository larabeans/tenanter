<?php

namespace App\Containers\Larabeans\Tenanter\Tasks\Configurationer;


use App\Containers\Larabeans\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Larabeans\Tenanter\Contracts\Host;
use App\Containers\Larabeans\Tenanter\Contracts\Tenant;
use App\Containers\Larabeans\Tenanter\Models\Domain;
use App\Containers\Larabeans\Tenanter\Traits\IsTenantAdminTrait;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Requests\Request;
use App\Ship\Parents\Tasks\Task;


class UpdateDomainConfigurationTask extends Task
{
    use IsTenantAdminTrait;

    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Request $request, $configuration, $key, $id)
    {
        try {

            $configurable = $configuration->configurable;

            if($configurable instanceof Domain) {

                // domainable entity (i.e domain belongs to host or tenant)
                $domainable = $configurable -> domainable;

                // Check if domain belongs to Host, host admin is performing task, &
                // if domain belongs to tenant, tenant admin is performing task
                if(
                    ($domainable instanceof Host && $domainable->id === host()->getHostKey() && tenancy()->isValidHostAdmin()) ||
                    ($domainable instanceof Tenant && $domainable->id === tenant()->getTenantKey() && tenancy()->isValidTenantAdmin())
                ) {

                    $data = [
                        'configuration' => json_encode($request->configuration)
                    ];

                    $configurations = $this->repository->update($data, $id);

                    $configurations->configuration = json_decode($configurations->configuration);

                    return $configurations;
                }
            }

        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }

    }
}
