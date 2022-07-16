<?php

namespace App\Containers\Larabeans\Tenanter\Tasks;

use App\Containers\Larabeans\Configurationer\Configurationer;
use App\Containers\Larabeans\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Requests\Request;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Parents\Exceptions\Exception;

class GetResolvedHostConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Request $request, $type ,$transform =null)
    {
         if(tenancy()->initialized && tenancy()->hostInitialized) {

             $configurations = $this->repository->findWhere([
                 'configurable_id' => host()->getHostKey(),
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
                             'host' => host()->getHostKey(),
                             'admin' => tenancy()->isValidHostAdmin(),
                             'side' => tenancy()->side()
                         )
                     )
                 );
             }
         }

        return [];
    }
}
