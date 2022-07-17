<?php

namespace App\Containers\Larabeans\Tenanter\Tasks;

use App\Containers\Larabeans\Configurationer\Configurationer;
use App\Containers\Larabeans\Tenanter\Data\Repositories\DomainRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CreateDomainTask extends Task
{
    protected DomainRepository $repository;

    public function __construct(DomainRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($domain, $primary, $type, $id)
    {
        try {
            if ( $model = configurationer()::getModel($type)) {

                $queryData = [
                    'domainable_type' => $model,
                    'domainable_id' => $id,
                    'domain' => $domain,
                    'is_primary' => $primary,
                    'dns_verification_hostname' => $primary ? null : (Str::random(5) . '.' . $domain),
                    'dns_verification_code' => $primary ? null : (Str::random(14))
                ];
                return $this->repository->create($queryData);
            }

            throw new NotFoundException();

        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception);
        }
    }
}
