<?php

namespace App\Containers\Larabeans\Tenanter\Contracts;

/**
 * TenancyBootstrappers are classes that make your application tenant-aware automatically.
 */
interface TenancyBootstrapper
{
    public function bootstrap(Tenant $tenant);

    public function revert();
}
