<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Requests\Request;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetResolvedHostConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Request $request, $type)
    {
        try {

            if(! tenancy()->initialized ||  ! tenancy()->hostInitialized) {
                throw new Exception();
            }

            $configurations = $this->repository->findWhere([
                'configurable_id' => host()->getHostKey(),
                'configurable_type' => configurationer()::getModel($type)
            ])->first();

            $configurations = json_decode($configurations->configuration);

            return [
                'data' => $configurations
            ];
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
