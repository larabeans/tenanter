<?php

declare(strict_types=1);

namespace App\Containers\Vendor\Tenanter\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Containers\Vendor\Tenanter\Exceptions\RouteIsMissingTenantParameterException;
use App\Containers\Vendor\Tenanter\Resolvers\PathTenantResolver;
use App\Containers\Vendor\Tenanter\Tenancy;

class InitializeTenancyByPath extends IdentificationMiddleware
{
    /** @var callable|null */
    public static $onFail;

    /** @var Tenancy */
    protected $tenancy;

    /** @var PathTenantResolver */
    protected $resolver;

    public function __construct(Tenancy $tenancy, PathTenantResolver $resolver)
    {
        $this->tenancy = $tenancy;
        $this->resolver = $resolver;
    }

    public function handle(Request $request, Closure $next)
    {
        /** @var Route $route */
        $route = $request->route();

        // Only initialize tenancy if tenant is the first parameter
        // We don't want to initialize tenancy if the tenant is
        // simply injected into some route controller action.
        if ($route->parameterNames()[0] === PathTenantResolver::$tenantParameterName) {
            return $this->initializeTenancy(
                $request, $next, $route
            );
        } else {
            throw new RouteIsMissingTenantParameterException;
        }

        return $next($request);
    }
}
