<?php

namespace App\Containers\Larabeans\Tenanter\Tasks;

use App\Containers\Larabeans\Tenanter\Data\Repositories\DomainRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Support\Str;

class FindDomainTask extends Task
{
    protected DomainRepository $repository;

    public function __construct(DomainRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($idOrDomain)
    {
        try {
            $query = (is_numeric($idOrDomain) || Str::isUuid($idOrDomain)) ? ['id' => $idOrDomain] : ['domain' => $idOrDomain];
            return $this->repository->findWhere($query)->first();
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
