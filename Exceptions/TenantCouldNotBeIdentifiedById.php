<?php

namespace App\Containers\Vendor\Tenanter\Exceptions;

use Facade\IgnitionContracts\BaseSolution;
use Facade\IgnitionContracts\ProvidesSolution;
use Facade\IgnitionContracts\Solution;
use App\Containers\Vendor\Tenanter\Contracts\TenantCouldNotBeIdentifiedException;

// todo: in v3 this should be suffixed with Exception
class TenantCouldNotBeIdentifiedById extends TenantCouldNotBeIdentifiedException implements ProvidesSolution
{
    public function __construct($tenant_id)
    {
        parent::__construct("Tenant could not be identified with tenant_id: $tenant_id");
    }

    public function getSolution(): Solution
    {
        return BaseSolution::create('Tenant could not be identified with that ID')
            ->setSolutionDescription('Are you sure the ID is correct and the tenant exists?')
            ->setDocumentationLinks([
                'Initializing Tenants' => 'link here',
            ]);
    }
}
