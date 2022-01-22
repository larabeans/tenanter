<?php

declare(strict_types=1);

namespace App\Containers\Vendor\Tenanter\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Containers\Vendor\Tenanter\Exceptions\TenancyNotInitializedException;

class ScopeSessions
{
    public static $tenantIdKey = '_tenant_id';

    public function handle(Request $request, Closure $next)
    {
        if (! tenancy()->initialized || ! tenancy()->tenantInitialized) {
            throw new TenancyNotInitializedException('Tenancy needs to be initialized before the session scoping middleware is executed');
        }

        if (! $request->session()->has(static::$tenantIdKey)) {
            $request->session()->put(static::$tenantIdKey, tenant()->getTenantKey());
        } else {
            if ($request->session()->get(static::$tenantIdKey) !== tenant()->getTenantKey()) {
                abort(403);
            }
        }

        return $next($request);
    }
}
