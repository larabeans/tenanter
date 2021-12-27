<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
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
        // TODO: Instead of using header, use resolved domain and tenancy object
        $domain = app(FindDomainTask::class)->run($request->header('Axis-Host'));

        try {
            $configurations = $this->repository->findWhere([
                'configurable_id' => $domain->id,
                'configurable_type' => configurationer()::getModel($type)
            ])->first();
            $configurations = json_decode($configurations->configuration);
            return ['data'=>$configurations];
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
