<?php

namespace App\Containers\Vendor\Tenanter\Middleware;

use Closure;
use App\Containers\Vendor\Tenanter\Resolvers\RequestHeaderHostResolver;
use App\Containers\Vendor\Tenanter\Tasks\GetHostPrimaryDomainsTask;
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
        $hostDomain = app(GetHostPrimaryDomainsTask::class)
                        ->run()
                        ->pluck('domain')
                        ->toArray();

        $domain = $this->getAxisHost($request);

        if(in_array($domain, $hostDomain)) {
            return $this->initializeHost(
                $request, $next, $this->getAxisHost($request)
            );
        }

        return $next($request);
    }

    protected function getAxisHost( $request)
    {
        if($request->header(config('tenanter.tenancy.header_attribute'))) {
            return $request->header(config('tenanter.tenancy.header_attribute'));
        }

        return '';
    }
}
