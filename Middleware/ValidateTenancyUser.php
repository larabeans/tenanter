<?php

namespace App\Containers\Larabeans\Tenanter\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Containers\Larabeans\Tenanter\Exceptions\UserCouldNotBeIdentifiedOnDomainException;

class ValidateTenancyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( (Auth::check() && tenancy()->initialized && tenancy()->tenantInitialized && !tenancy()->isValidTenantUser()) || (Auth::check() && tenancy()->initialized && tenancy()->hostInitialized && !tenancy()->isValidHostUser())){
            throw new UserCouldNotBeIdentifiedOnDomainException('');
        }

        return $next($request);
    }
}
