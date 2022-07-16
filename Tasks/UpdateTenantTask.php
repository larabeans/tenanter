<?php

namespace App\Containers\Larabeans\Tenanter\Tasks;

use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Support\Str;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Larabeans\Tenanter\Data\Repositories\TenantRepository;

class UpdateTenantTask extends Task
{
    protected TenantRepository $repository;

    public function __construct(TenantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, $data)
    {
        try {

            if (isset($data['name'])) {
                $data['slug'] = Str::slug($data['name']);
            }

            return $this->repository->update($data, $id);

        } catch (Exception $exception) {
            throw new UpdateResourceFailedException($exception);
        }

    }
}
