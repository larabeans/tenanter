<?php

declare(strict_types=1);

namespace App\Containers\Vendor\Tenanter\Middleware;

use Closure;
use App\Containers\Vendor\Tenanter\Resolvers\DomainTenantResolver;
use App\Containers\Vendor\Tenanter\Tenancy;

class InitializeTenancyByDomain extends IdentificationMiddleware
{
    /** @var callable|null */
    public static $onFail;

    /** @var Tenancy */
    protected $tenancy;

    /** @var DomainTenantResolver */
    protected $resolver;

    public function __construct(Tenancy $tenancy, DomainTenantResolver $resolver)
    {
        $this->tenancy = $tenancy;
        $this->resolver = $resolver;
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
        return $this->initializeTenant(
            $request, $next, $request->getHost()
        );
    }
}
