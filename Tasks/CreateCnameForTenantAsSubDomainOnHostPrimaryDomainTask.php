<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Tenanter\Data\Repositories\DomainRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CreateCnameForTenantAsSubDomainOnHostPrimaryDomainTask extends Task
{
    protected DomainRepository $repository;

    public function __construct(DomainRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($name, $type, $id)
    {
        try {
            if ( $entity = configurationer()::getConfigurableEntity($type)) {

                $queryData = [
                    'domainable_type' => $entity['model'],
                    'domainable_id' => $id,
                    'domain' => $this->createCname($name),
                    'is_verified' => true
                ];
                return $this->repository->create($queryData);
            }

            throw new NotFoundException();

        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception);
        }
    }

    private function createCname($name) {
        // TODO: Get host primary domain, attache tenant-name to create cname for new tenant
        $hostDomain = config('tenanter.host_domains');

        return $name . '.' . $hostDomain[1];
    }
}
