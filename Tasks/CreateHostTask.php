<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Tenanter\Data\Repositories\HostRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Str;

class CreateHostTask extends Task
{
    protected HostRepository $repository;

    public function __construct(HostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($name)
    {
        try {
            $data = [
                'slug' => Str::slug($name),
                'name' => $name,
                'is_active' => true,
            ];
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException($exception);
        }
    }
}
