<?php

namespace App\Containers\Vendor\Tenanter\Middleware;

use App\Containers\Vendor\Tenanter\Contracts\TenantCouldNotBeIdentifiedException;
use App\Containers\Vendor\Tenanter\Contracts\TenantResolver;
use App\Containers\Vendor\Tenanter\Tenancy;

abstract class IdentificationMiddleware
{
    /** @var callable */
    public static $onFail;

    /** @var Tenancy */
    protected $tenancy;

    /** @var TenantResolver */
    protected $resolver;

    public function initializeTenancy($request, $next, ...$resolverArguments)
    {
        if($this->tenancy->host) {
            // host domain check already passed, continue with host context
            return $next($request);
        } else {
            try {
                $this->tenancy->initialize(
                    $this->resolver->resolve(...$resolverArguments)
                );
            } catch (TenantCouldNotBeIdentifiedException $e) {
                $onFail = static::$onFail ?? function ($e) {
                        throw $e;
                    };

                return $onFail($e, $request, $next);
            }
        }

        return $next($request);
    }
}
