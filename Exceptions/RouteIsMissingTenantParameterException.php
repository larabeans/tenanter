<?php

namespace App\Containers\Larabeans\Tenanter\Exceptions;

use Exception;
use App\Containers\Larabeans\Tenanter\Resolvers\PathTenantResolver;

class RouteIsMissingTenantParameterException extends Exception
{
    public function __construct()
    {
        $parameter = PathTenantResolver::$tenantParameterName;

        parent::__construct("The route's first argument is not the tenant id (configured paramter name: $parameter).");
    }
}
