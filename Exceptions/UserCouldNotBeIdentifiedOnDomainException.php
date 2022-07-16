<?php

namespace App\Containers\Larabeans\Tenanter\Exceptions;

use Facade\IgnitionContracts\BaseSolution;
use Facade\IgnitionContracts\ProvidesSolution;
use Facade\IgnitionContracts\Solution;
use App\Containers\Larabeans\Tenanter\Contracts\UserCouldNotBeIdentifiedException;

class UserCouldNotBeIdentifiedOnDomainException extends UserCouldNotBeIdentifiedException implements ProvidesSolution
{
    public function __construct($domain)
    {
        parent::__construct("User could not be identified on domain $domain",406);
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
