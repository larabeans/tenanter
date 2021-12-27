<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Tenanter\Tenancy;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Parents\Requests\Request;
use Exception;

class GetResolvedDomainConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Request $request, $type)
    {
         if(tenancy()->initialized && (tenancy()->hostInitialized || tenancy()->tenantInitialized )) {

             $configurations = $this->repository->findWhere([
                 'configurable_id' => domain()->id,
                 'configurable_type' => configurationer()::getModel($type)
             ])->first();

             if ($configurations) {
                 return (array) json_decode($configurations->configuration);
             }
         }

         return [];
    }
}
