<?php

namespace App\Containers\Larabeans\Tenanter\Tasks\Configurationer;

use App\Containers\Larabeans\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Parents\Requests\Request;
use App\Ship\Parents\Tasks\Task;

class GetResolvedDomainConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Request $request, $type, $transform=null)
    {
         if(tenancy()->initialized && (tenancy()->hostInitialized || tenancy()->tenantInitialized )) {

             $configurations = $this->repository->findWhere([
                 'configurable_id' => domain()->id,
                 'configurable_type' => configurationer()::getModel($type)
             ])->first();

             if ($configurations) {
                 $configurations->configuration = (array) json_decode($configurations->configuration);
                 if($transform) {
                     return $configurations;
                 }
                 return $configurations->configuration;
             }
         }

         return [];
    }
}
