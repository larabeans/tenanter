<?php

namespace App\Containers\Vendor\Tenanter\Middleware;

use Closure;
use App\Containers\Vendor\Tenanter\Resolvers\RequestHeaderHostResolver;
use App\Containers\Vendor\Tenanter\Tenancy;


class InitializeHostContext extends IdentificationMiddleware
{
    /** @var callable|null */
    public static $onFail;

    /** @var Tenancy */
    protected $tenancy;

    /** @var RequestHeaderHostResolver */
    protected $resolver;

    public function __construct(Tenancy $tenancy, RequestHeaderHostResolver $resolver)
    {
        $this->tenancy = $tenancy;
        $this->resolver = $resolver;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $this->initializeHost(
            $request, $next, $this->getAxisHost($request)
        );
    }

    protected function getAxisHost( $request)
    {
        if($request->header(config('tenanter.tenancy.header-attribute'))) {
            return $request->header(config('tenanter.tenancy.header-attribute'));
        }

        return false;
    }


//    /**
//     * Handle an incoming request.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \Closure  $next
//     * @return mixed
//     */
//    public function handle($request, Closure $next)
//    {
//        return $this->checkHost(
//            $request, $next, $request->header(config('tenanter.tenancy.header_attribute'))
//        );
//    }

//    public function checkHost($request, $next, ...$resolverArguments)
//    {
//        $domain = $resolverArguments[0];
//        /**
//         * Check domain is associated with host domains,
//         * if true set host context true else identify tenancy
//         */
//        if(in_array($domain, config('tenanter.host_domains'))){
//            $this->tenancy->host = true;
//        }
//
//        return $next($request);
//    }
}
