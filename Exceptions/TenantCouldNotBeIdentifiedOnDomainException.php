<?php

namespace App\Containers\Larabeans\Tenanter\Exceptions;

use Facade\IgnitionContracts\BaseSolution;
use Facade\IgnitionContracts\ProvidesSolution;
use Facade\IgnitionContracts\Solution;
use App\Containers\Larabeans\Tenanter\Contracts\TenantCouldNotBeIdentifiedException;

class TenantCouldNotBeIdentifiedOnDomainException extends TenantCouldNotBeIdentifiedException implements ProvidesSolution
{
    public function __construct($domain)
    {
        parent::__construct("Tenant could not be identified on domain $domain", 406);
    }

    public function getSolution(): Solution
    {
        return BaseSolution::create('Tenant could not be identified on this domain')
            ->setSolutionDescription('Did you forget to create a tenant for this domain?')
            ->setDocumentationLinks([
                'Creating Tenants' => 'https://larabeans.com/docs/v3/tenants/',
            ]);
    }
}
