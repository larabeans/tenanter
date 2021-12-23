<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Tenanter\Data\Repositories\DomainRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CreateDomainTask extends Task
{
    protected DomainRepository $repository;

    public function __construct(DomainRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($domain, $type, $id)
    {
        try {
            if ( $entity = configurationer()::getConfigurableEntity($type)) {

                $queryData = [
                    'domainable_type' => $entity['model'],
                    'domainable_id' => $id,
                    'domain' => $domain,
                    'dns_verification_hostname' => Str::random(5) . '.' . $domain,
                    'dns_verification_code' => Str::random(14)
                ];
                return $this->repository->create($queryData);
            }

            throw new NotFoundException();

        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception);
        }
    }
}
