<?php

declare(strict_types=1);

namespace App\Containers\Vendor\Tenanter\Exceptions;

use Facade\IgnitionContracts\BaseSolution;
use Facade\IgnitionContracts\ProvidesSolution;
use Facade\IgnitionContracts\Solution;
use App\Containers\Vendor\Tenanter\Contracts\HostCouldNotBeIdentifiedException;

class HostCouldNotBeIdentifiedByRequestHeaderException extends HostCouldNotBeIdentifiedException implements ProvidesSolution
{
    public function __construct($axisHost)
    {
        parent::__construct("Host could not be identified by request header with " . config('tenanter.tenancy.header-attribute') . " : $axisHost");
    }

    public function getSolution(): Solution
    {
        return BaseSolution::create('Host could not be identified with this request header')
            ->setSolutionDescription('Did you forget to add ' . config('tenanter.tenancy.header-attribute') . ' header with this domain?')
            ->setDocumentationLinks([
                'Creating Tenants' => 'https://larabeans.com/docs/v3/tenants/',
            ]);
    }
}
