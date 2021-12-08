<?php

namespace App\Containers\Vendor\Tenanter\Exceptions;

use Exception;

class NotASubdomainException extends Exception
{
    public function __construct(string $hostname)
    {
        parent::__construct("Hostname $hostname does not include a subdomain.");
    }
}
