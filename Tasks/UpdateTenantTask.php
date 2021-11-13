<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Tenanter\Data\Repositories\TenantRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Exceptions\NotAuthorizedResourceException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use App\Containers\Vendor\Tenanter\Traits\IsTenantAdminTrait;

class UpdateTenantTask extends Task
{
    use IsTenantAdminTrait;

    protected $repository;

    public function __construct(TenantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, $data)
    {
        if ($this->isTenantAdmin($id)) {
            try {
                return $this->repository->update($data, $id);
            } catch (Exception $exception) {
                throw new UpdateResourceFailedException($exception);
            }
        } else {
            throw new NotAuthorizedResourceException();
        }
    }
}
