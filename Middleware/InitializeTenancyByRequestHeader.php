<?php
namespace App\Containers\Vendor\Tenanter\Middleware;

use Closure;
use App\Containers\Vendor\Tenanter\Resolvers\RequestHeaderTenantResolver;
use App\Containers\Vendor\Tenanter\Tenancy;

class InitializeTenancyByRequestHeader extends IdentificationMiddleware
{
    /** @var callable|null */
    public static $onFail;

    /** @var Tenancy */
    protected $tenancy;

    /** @var DomainTenantResolver */
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
        return $this->initializeTenancy(
            $request, $next, $this->getAxisHost($request)
        );
    }

    protected function getAxisHost( $request)
    {
        if($request->header('Axis-Host')) {
            return $request->header('Axis-Host');
        }

        return false;
    }
}
