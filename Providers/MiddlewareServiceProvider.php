<?php

namespace App\Containers\Vendor\Tenanter\Providers;

use App\Ship\Parents\Providers\MiddlewareProvider;
use App\Containers\Vendor\Tenanter\Middleware;

class MiddlewareServiceProvider extends MiddlewareProvider
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected array $middlewares = [

    ];


    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected array $middlewareGroups = [
        'web' => [
            // ..
        ],
        'api' => [
            Middleware\InitializeHostContext::class,
            Middleware\InitializeTenancyByRequestHeader::class,
            Middleware\ValidateTenancyUser::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected array $routeMiddleware = [
        // Even higher priority than the initialization middleware
        'central.domain.access' => Middleware\PreventAccessFromHostDomains::class,
        'init.tenancy.domain' => Middleware\InitializeTenancyByDomain::class,
        'init.tenancy.subdomain' => Middleware\InitializeTenancyBySubdomain::class,
        'init.tenancy.domain.subdomain' => Middleware\InitializeTenancyByDomainOrSubdomain::class,
        'init.tenancy.path' => Middleware\InitializeTenancyByPath::class,
        'init.tenancy.request' => Middleware\InitializeTenancyByRequestData::class,
        'init.tenancy.header' => Middleware\InitializeTenancyByRequestHeader::class,
    ];


    /**
     * The priority-sorted list of middleware.
     *
     * Forces non-global middleware to always be in the given order.
     *
     * @var string[]
     */
    protected array $middlewarePriority = [
        Middleware\InitializeHostContext::class,
        Middleware\InitializeTenancyByRequestHeader::class,
        Middleware\ValidateTenancyUser::class,
    ];

    public function boot() : void
    {
        parent::boot();
        // $this->makeTenancyMiddlewareHighestPriority();
    }

    protected function makeTenancyMiddlewareHighestPriority()
    {
        $tenancyMiddleware = [
            // Even higher priority than the initialization middleware
            Middleware\PreventAccessFromHostDomains::class,

            Middleware\InitializeTenancyByDomain::class,
            Middleware\InitializeTenancyBySubdomain::class,
            Middleware\InitializeTenancyByDomainOrSubdomain::class,
            Middleware\InitializeTenancyByPath::class,
            Middleware\InitializeTenancyByRequestData::class,
        ];

        foreach (array_reverse($tenancyMiddleware) as $middleware) {
            $this->app[\Illuminate\Contracts\Http\Kernel::class]->prependToMiddlewarePriority($middleware);
        }
    }
}
