<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Tenanter\Data\Repositories\TenantRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllTenantsTask extends Task
{

    protected $repository;

    public function __construct(TenantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
