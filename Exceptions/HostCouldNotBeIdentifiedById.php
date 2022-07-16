<?php

namespace App\Containers\Larabeans\Tenanter\Exceptions;

use Facade\IgnitionContracts\BaseSolution;
use Facade\IgnitionContracts\ProvidesSolution;
use Facade\IgnitionContracts\Solution;
use App\Containers\Larabeans\Tenanter\Contracts\HostCouldNotBeIdentifiedException;

class HostCouldNotBeIdentifiedById extends HostCouldNotBeIdentifiedException implements ProvidesSolution
{
    public function __construct($host_id)
    {
        parent::__construct("Host could not be identified with tenant_id: $host_id");
    }

    public function getSolution(): Solution
    {
        return BaseSolution::create('Host could not be identified with that ID')
            ->setSolutionDescription('Are you sure the ID is correct and the host exists?')
            ->setDocumentationLinks([
                'Initializing Hosts' => 'link here',
            ]);
    }
}
