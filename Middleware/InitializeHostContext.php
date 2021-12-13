<?php

namespace App\Containers\Vendor\Tenanter\Middleware;

use Closure;
use App\Containers\Vendor\Tenanter\Tenancy;


class InitializeHostContext
{
    /** @var callable|null */
    public static $onFail;

    /** @var Tenancy */
    protected $tenancy;

    public function __construct(Tenancy $tenancy)
    {
        $this->tenancy = $tenancy;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $this->checkHost(
            $request, $next, $request->header(config('tenanter.tenancy.header_attribute'))
        );
    }

    public function checkHost($request, $next, ...$resolverArguments)
    {
        $domain = $resolverArguments[0];
        /**
         * Check domain is associated with host domains,
         * if true set host context true else identify tenancy
         */
        if(in_array($domain, config('tenanter.host_domains'))){
            $this->tenancy->host = true;
        }

        return $next($request);
    }
}
