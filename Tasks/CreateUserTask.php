<?php

namespace App\Containers\Larabeans\Tenanter\Tasks;

use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Support\Facades\Hash;
use App\Ship\Parents\Tasks\Task;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;

class CreateUserTask extends Task
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(
        bool $is_admin,
        string $tenant_id,
        string $name,
        string $email,
        string $password
    ) {
        try {
            return $this->repository->create([
                'tenant_id' => $tenant_id,
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ]);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
