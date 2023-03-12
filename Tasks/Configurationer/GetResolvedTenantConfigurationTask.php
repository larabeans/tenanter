<?php

namespace App\Containers\Larabeans\Tenanter\Tasks\Configurationer;

use App\Containers\Larabeans\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Parents\Requests\Request;
use App\Ship\Parents\Tasks\Task;

class GetResolvedTenantConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Request $request, $type, $transform=null)
    {
         if(tenancy()->initialized && tenancy()->tenantInitialized) {

             $configurations = $this->repository->findWhere([
                 'configurable_id' => tenant()->getTenantKey(),
                 'configurable_type' => configurationer()::getModel($type)
             ])->first();

             if ($configurations) {
                 $configurations->configuration = (array) json_decode($configurations->configuration);
                 if($transform) {
                     return $configurations;
                 }
                 return array_merge(
                     $configurations->configuration,
                     array(
                         'session' => array (
                             'tenant' => tenant()->getTenantKey(),
                             'admin' => tenancy()->isValidTenantAdmin(),
                             'side' => tenancy()->side()
                         )
                     )
                 );
             }
         }

        return [];
    }
}
