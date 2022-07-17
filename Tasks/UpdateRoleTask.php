<?php

namespace App\Containers\Larabeans\Tenanter\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateRoleTask extends Task
{
    protected RoleRepository $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
