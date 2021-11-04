<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Tenanter\Data\Repositories\TenantRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Str;

class FindTenantByIdOrDomainNameTask extends Task
{
    protected TenantRepository $repository;

    public function __construct(TenantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($idOrDomain)
    {
        try {
            $query = (is_numeric($idOrDomain)||Str::isUuid($idOrDomain))?['id'=>$idOrDomain]:['domain'=>$idOrDomain];
            return $this->repository->findWhere($query)->first();
        } catch (Exception $exception) {
            throw new NotFoundException($exception);
        }
    }
}
