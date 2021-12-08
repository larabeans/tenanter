<?php

namespace App\Containers\Vendor\Tenanter\Exceptions;

use Exception;

class DomainOccupiedByOtherTenantException extends Exception
{
    public function __construct($domain)
    {
        parent::__construct("The $domain domain is occupied by another tenant.");
    }
}
