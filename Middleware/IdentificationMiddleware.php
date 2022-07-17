<?php

namespace App\Containers\Larabeans\Tenanter\Middleware;

use App\Containers\Larabeans\Tenanter\Contracts\HostCouldNotBeIdentifiedException;
use App\Containers\Larabeans\Tenanter\Contracts\TenantCouldNotBeIdentifiedException;
use App\Containers\Larabeans\Tenanter\Contracts\TenantResolver;
use App\Containers\Larabeans\Tenanter\Tenancy;

abstract class IdentificationMiddleware
{
    /** @var callable */
    public static $onFail;

    /** @var Tenancy */
    protected $tenancy;

    /** @var TenantResolver|HostResolver */
    protected $resolver;

    public function initializeTenant($request, $next, ...$resolverArguments)
    {
        if(! $this->tenancy->host) {
            try {
                $this->tenancy->initializeTenant(
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

    public function initializeHost($request, $next, ...$resolverArguments)
    {

        try {
            $this->tenancy->initializeHost(
                $this->resolver->resolve(...$resolverArguments)
            );
        } catch (HostCouldNotBeIdentifiedException $e) {
            $onFail = static::$onFail ?? function ($e) {
                    throw $e;
                };

            return $onFail($e, $request, $next);
        }

        return $next($request);
    }
}
