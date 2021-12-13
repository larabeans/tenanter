<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use Exception;
use Illuminate\Support\Facades\Auth;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;

class CreateTenantConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        $configurationType = config('configurationer.entities');
        $index = "";
        $type = $data['configurable_type'];
        foreach ($configurationType as $key => $value) {
            if ($key == $type) {
                $index = $value['model'];
            }
        }
        $Configurable_id = $data['tenant_id'];
        $configurationData = json_encode($data['configuration']);
        $queryData = [
            'configurable_type' => $index,
            'configurable_id' => $Configurable_id,
            'configuration' => $configurationData,
            'tenant_id' => $data['tenant_id']
        ];

        try {
            return $this->repository->create($queryData);

        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
