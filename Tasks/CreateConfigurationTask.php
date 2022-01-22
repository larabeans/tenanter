<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Configurationer\Configurationer;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;

class CreateConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            if ( $model = configurationer()::getModel($data['configurable_type'])) {
                $queryData = [
                    'configurable_type' => $model,
                    'configurable_id' => $data['id'],
                    'configuration' => json_encode($data['configuration']),
                ];
                return $this->repository->create($queryData);
            }

            throw new NotFoundException();

        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
