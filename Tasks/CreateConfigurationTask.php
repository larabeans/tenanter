<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use Exception;
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
            if ( $entity = configurationer()::getConfigurableEntity($data['configurable_type'])) {
                $queryData = [
                    'configurable_type' => $entity['model'],
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
