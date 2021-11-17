<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Configurationer\Traits\IsHostAdminTrait;
use App\Containers\Vendor\Tenanter\Data\Repositories\TenantRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Exceptions\NotAuthorizedResourceException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use App\Containers\Vendor\Tenanter\Traits\IsTenantAdminTrait;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;
use function PHPUnit\Framework\throwException;

class UpdateTenantTask extends Task
{
    use IsTenantAdminTrait;
    use IsHostAdminTrait;

    protected TenantRepository $repository;

    public function __construct(TenantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, $data)
    {
        try {
            if ($this->isTenantAdmin($id) || $this->isHostAdmin()) {
                if (isset($data['name'])) {
                    $data['slug'] = Str::slug($data['name']);
                }
                return $this->repository->update($data, $id);
            } else {
                throw new UnauthorizedException();
            }
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException($exception);
        }

    }
}
