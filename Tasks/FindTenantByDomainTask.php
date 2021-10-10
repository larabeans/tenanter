<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Tenanter\Data\Repositories\TenantRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindTenantByDomainTask extends Task
{
    protected TenantRepository $repository;

    public function __construct(TenantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($domain)
    {
        try {
            return $this->repository->where('domain',$domain)->first();
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
