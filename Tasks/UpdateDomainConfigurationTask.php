<?php

namespace App\Containers\Vendor\Tenanter\Tasks;


use App\Ship\Parents\Tasks\Task;
use App\Ship\Parents\Requests\Request;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationHistoryRepository;
use App\Containers\Vendor\Tenanter\Traits\IsTenantAdminTrait;
use App\Containers\Vendor\Tenanter\Contracts\Host;
use App\Containers\Vendor\Tenanter\Contracts\Tenant;



class UpdateDomainConfigurationTask extends Task
{
    use IsTenantAdminTrait;

    protected ConfigurationRepository $repository;
    protected ConfigurationHistoryRepository $historyRepository;

    public function __construct(
        ConfigurationRepository $repository,
        ConfigurationHistoryRepository $historyRepository)
    {
        $this->repository = $repository;
        $this->historyRepository = $historyRepository;
    }

    public function run(Request $request, $configuration, $key, $id)
    {
        try {

            $configurable = $configuration -> configurable;

            if($configurable instanceof Domain) {

                // domainable entity (i.e domain belongs to entity) host or tenant
                $domainable = $configurable -> domainable;

                if(
                    ($domainable instanceof Host && $domainable->id === host()->getHostKey() && tenancy()->isValidHostAdmin()) ||
                    ($domainable instanceof Tenant && $domainable->id === tenant()->getTenantKey() && tenancy()->isValidTenantAdmin())
                ) {
                    // First Save History
                    $history = [
                        "configuration_id" => $configuration->id,
                        "configuration" => $configuration->configuration
                    ];
                    $this->historyRepository->create($history);

                    // Update Configurations
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
