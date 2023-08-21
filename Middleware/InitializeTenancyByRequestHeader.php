<?php
namespace App\Containers\Larabeans\Tenanter\Middleware;

use Closure;
use App\Containers\Larabeans\Tenanter\Resolvers\RequestHeaderTenantResolver;
use App\Containers\Larabeans\Tenanter\Tenancy;

class InitializeTenancyByRequestHeader extends IdentificationMiddleware
{
    /** @var callable|null */
    public static $onFail;

    /** @var Tenancy */
    protected $tenancy;

    /** @var RequestHeaderTenantResolver */
    protected $resolver;

    public function __construct(Tenancy $tenancy, RequestHeaderTenantResolver $resolver)
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
        return $this->initializeTenant(
            $request, $next, $this->getAxisHost($request)
        );
    }

    protected function getAxisHost( $request)
    {
        if($request->header(tenancyConfig('header_attribute'))) {
            return $request->header(tenancyConfig('header_attribute'));
        }

        return false;
    }
}
