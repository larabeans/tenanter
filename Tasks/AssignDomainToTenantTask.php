<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Tenanter\Data\Repositories\DomainRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class AssignDomainToTenantTask extends Task
{
    protected DomainRepository $repository;

    public function __construct(DomainRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($name)
    {
        $domain = config('tenanter.host_domains');
        $data = [
            'domain' => $name . '.' . $domain[1],
            'is_active' => false,
            'is_verified' => false
        ];
        try {
            return $this->repository->create($data);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception);
        }
    }
}
