<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Exceptions\Exception;
use App\Containers\Vendor\Tenanter\Data\Repositories\DomainRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllTenantDomainsTask extends Task
{
    protected DomainRepository $repository;

    public function __construct(DomainRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->findWhere(['domainable_id'=>$id]);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }

    }
}
