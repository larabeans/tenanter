<?php

namespace App\Containers\Vendor\Tenanter\Contracts;

/**
 * TenancyBootstrappers are classes that make your application tenant-aware automatically.
 */
interface TenancyBootstrapper
{
    public function bootstrap(Tenant $tenant);

    public function revert();
}
