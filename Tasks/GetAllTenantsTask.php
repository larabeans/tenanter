<?php

namespace App\Containers\Larabeans\Tenanter\Tasks;

use App\Containers\Larabeans\Tenanter\Data\Repositories\TenantRepository;
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
