<?php

declare(strict_types=1);

namespace App\Containers\Larabeans\Tenanter\Exceptions;

use Facade\IgnitionContracts\BaseSolution;
use Facade\IgnitionContracts\ProvidesSolution;
use Facade\IgnitionContracts\Solution;
use App\Containers\Larabeans\Tenanter\Contracts\HostCouldNotBeIdentifiedException;

class HostCouldNotBeIdentifiedByRequestHeaderException extends HostCouldNotBeIdentifiedException implements ProvidesSolution
{
    public function __construct($axisHost)
    {
        parent::__construct("Host could not be identified by request header with " . tenancyConfig('header_attribute') . " : $axisHost");
    }

    public function getSolution(): Solution
    {
        return BaseSolution::create('Host could not be identified with this request header')
            ->setSolutionDescription('Did you forget to add ' . tenancyConfig('header_attribute') . ' header with this domain?')
            ->setDocumentationLinks([
                'Creating Tenants' => 'https://larabeans.com/docs/v3/tenants/',
            ]);
    }
}
