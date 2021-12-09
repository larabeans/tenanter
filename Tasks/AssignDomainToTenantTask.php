<?php

namespace App\Containers\Vendor\Tenanter\Tasks;

use App\Containers\Vendor\Tenanter\Data\Repositories\DomainRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class AssignDomainToTenantTask extends Task
{
    protected DomainRepository $repository;

    public function __construct(DomainRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($name, $new = false)
    {

        $domain = null;
        $dnsHostname = null;
        $dnsCode = null;

        if ($new == false) {
            $hostDomain = config('tenanter.host_domains');
            $domain = $name . '.' . $hostDomain[1];
        } else {
            $domain = $name;
            $dnsHostname = Str::random(5) . '.' . $domain;
            $dnsCode = Str::random(14);
        }

        $data = [
            'domain' => $domain,
            'is_active' => false,
            'is_verified' => false,
            'dns_verification_hostname' => $dnsHostname,
            'dns_verification_code' => $dnsCode,
            'verified_at' => null
        ];
        try {
            return $this->repository->create($data);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception);
        }
    }
}
