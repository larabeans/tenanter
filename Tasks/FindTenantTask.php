<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Tenanter\Data\Repositories\TenantRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Str;

class FindTenantTask extends Task
{

    protected $repository;

    public function __construct(TenantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($nameOrId)
    {
        try {
            $query = (is_numeric($nameOrId) || Str::isUuid($nameOrId)) ? ['id' => $nameOrId] : ['name' => $nameOrId];

            return $this->repository->findWhere($query)->first();
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
