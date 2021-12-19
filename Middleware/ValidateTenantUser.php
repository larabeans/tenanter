<?php

namespace App\Containers\Vendor\Tenanter\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Containers\Vendor\Tenanter\Exceptions\UserCouldNotBeIdentifiedOnDomainException;

class ValidateTenantUser
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
        if( Auth::check() && tenancy()->initialized && tenancy()->tenantInitialized && !tenancy()->validTenantUser()){
            throw new UserCouldNotBeIdentifiedOnDomainException('');
        }

        return $next($request);
    }
}
