<?php

namespace App\Containers\Vendor\Tenanter\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventAccessFromHostDomains
{
    /**
     * Set this property if you want to customize the on-fail behavior.
     *
     * @var callable|null
     */
    public static $abortRequest;

    public function handle(Request $request, Closure $next)
    {
        if (in_array($request->getHost(), config('tenanter.host_domains'))) {
            $abortRequest = static::$abortRequest ?? function () {
                abort(404);
            };

            return $abortRequest($request, $next);
        }

        return $next($request);
    }
}
