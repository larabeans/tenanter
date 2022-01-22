<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Vendor\Tenanter\Data\Repositories\TenantRepository;



class DeleteTenantTask extends Task
{
    protected $repository;

    public function __construct(TenantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->delete($id);
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
