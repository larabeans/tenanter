<?php

namespace App\Containers\Vendor\Tenanter\Exceptions;

use Facade\IgnitionContracts\BaseSolution;
use Facade\IgnitionContracts\ProvidesSolution;
use Facade\IgnitionContracts\Solution;
use App\Containers\Vendor\Tenanter\Contracts\TenantCouldNotBeIdentifiedException;

class UserCouldNotBeIdentifiedOnDomainException extends TenantCouldNotBeIdentifiedException implements ProvidesSolution
{
    public function __construct($domain)
    {
        parent::__construct("User could not be identified on domain $domain");
    }

    public function getSolution(): Solution
    {
        return BaseSolution::create('User could not be identified on this domain')
            ->setSolutionDescription('Did you forget to create a user for this domain?')
            ->setDocumentationLinks([
                'Creating User' => 'https://larabeans.com/docs/v3/users/',
            ]);
    }
}
