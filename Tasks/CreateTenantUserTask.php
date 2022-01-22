<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Support\Facades\Hash;
use App\Ship\Parents\Tasks\Task;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;

class CreateTenantUserTask extends Task
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(
        bool $is_admin,
        string $tenant_id,
        string $email,
        string $password
    ) {
        try {
            return $this->repository->create([
                'is_admin' => $is_admin,
                'tenant_id' => $tenant_id,
                'email' => $email,
                'password' => Hash::make($password)
            ]);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
