<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use Exception;
use Illuminate\Support\Str;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Vendor\Tenanter\Data\Repositories\TenantRepository;
use App\Containers\Vendor\Tenanter\Models\Tenant;

class CreateTenantTask extends Task
{
    protected $repository;

    public function __construct(TenantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(
        string $id = null,
        string $name,
        bool $isActive = null,
        string $domain,
        string $mode
    ): Tenant {
        $data = [
            'slug' => Str::slug($name),
            'name' => $name,
            'is_active' => $isActive ? true : false,
            'domain' => $domain,
            'mode' => $mode
        ];

        if (!is_null($id)) {
            $data['id'] = $id;
        }

        try {
            return $this->repository->create($data);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception);
        }
    }
}
