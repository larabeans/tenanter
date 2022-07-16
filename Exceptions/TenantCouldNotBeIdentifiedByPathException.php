<?php

declare(strict_types=1);

namespace App\Containers\Larabeans\Tenanter\Exceptions;

use Facade\IgnitionContracts\BaseSolution;
use Facade\IgnitionContracts\ProvidesSolution;
use Facade\IgnitionContracts\Solution;
use App\Containers\Larabeans\Tenanter\Contracts\TenantCouldNotBeIdentifiedException;

class TenantCouldNotBeIdentifiedByPathException extends TenantCouldNotBeIdentifiedException implements ProvidesSolution
{
    public function __construct($tenant_id)
    {
        parent::__construct("Tenant could not be identified on path with tenant_id: $tenant_id");
    }

    public function getSolution(): Solution
    {
        return BaseSolution::create('Tenant could not be identified on this path')
            ->setSolutionDescription('Did you forget to create a tenant for this path?')
            ->setDocumentationLinks([
                'Creating Tenants' => 'https://larabeans.com/docs/v3/tenants/',
            ]);
    }
}
