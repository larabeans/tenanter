<?php

namespace App\Containers\Vendor\Tenanter\Exceptions;

use Exception;

class TenancyNotInitializedException extends Exception
{
    public function __construct($message = '')
    {
        parent::__construct($message ?: 'Tenancy is not initialized.');
    }
}
