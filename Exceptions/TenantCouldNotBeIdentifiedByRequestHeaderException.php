<?php

declare(strict_types=1);

namespace App\Containers\Larabeans\Tenanter\Exceptions;

use Facade\IgnitionContracts\BaseSolution;
use Facade\IgnitionContracts\ProvidesSolution;
use Facade\IgnitionContracts\Solution;
use App\Containers\Larabeans\Tenanter\Contracts\TenantCouldNotBeIdentifiedException;

class TenantCouldNotBeIdentifiedByRequestHeaderException extends TenantCouldNotBeIdentifiedException implements ProvidesSolution
{
    public function __construct($axisHost)
    {
        parent::__construct("Tenant could not be identified by request header with Axis-Host: $axisHost");
    }

    public function getSolution(): Solution
    {
        return BaseSolution::create('Tenant could not be identified with this request header')
            ->setSolutionDescription('Did you forget to add Axis-Host header with this domain?')
            ->setDocumentationLinks([
                'Creating Tenants' => 'https://larabeans.com/docs/v3/tenants/',
            ]);
    }
}
