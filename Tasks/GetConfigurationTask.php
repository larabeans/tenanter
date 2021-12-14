<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($configurableId , $configurableTyep)
    {
        try {
            $configurations = $this->repository->findWhere([
                'configurable_id' => $configurableId
            ])->first();
            $configurations = json_decode($configurations->configuration);
            return ['data'=>$configurations];
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
