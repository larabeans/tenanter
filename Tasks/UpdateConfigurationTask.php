<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationHistoryRepository;
use App\Containers\Vendor\Tenanter\Data\Repositories\DomainRepository;
use App\Containers\Vendor\Tenanter\Traits\IsTenantAdminTrait;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateConfigurationTask extends Task
{
    use IsTenantAdminTrait;

    protected ConfigurationRepository $repository;
    protected DomainRepository  $domainRepository;
    protected ConfigurationHistoryRepository $historyRepository;

    public function __construct(
        ConfigurationRepository $repository,
        DomainRepository $domainRepository,
        ConfigurationHistoryRepository $historyRepository)
    {
        $this->repository = $repository;
        $this->domainRepository = $domainRepository;
        $this->historyRepository = $historyRepository;
    }

    public function run(array $data, $type, $domain)
    {
        $configurableId = null;
        if ($type == 'tenant' && $this->isTenantAdmin()) {
            $configurableId = tenant()->getKey();

        } elseif ($type == 'domain') {
            $d = $this->domainRepository->findWhere([
                'domain' => $domain
            ])->first();
            $configurableId = $d->id;
        }
        $configuration = $this->repository->findWhere([
            'configurable_id' => $configurableId
        ])->first();
        $id = $configuration->id;
        try {
            $this->historyRepository->create([
                "configuration_id" => $configuration->id,
                "configuration" => $configuration->configuration
            ]);
            $configurations = $this->repository->update($data, $id);
            $configurations->configuration = json_decode($configurations->configuration);
            return ['data' => $configurations->configuration];
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }

    }
}
