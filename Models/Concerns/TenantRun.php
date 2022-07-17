<?php

namespace App\Containers\Larabeans\Tenanter\Models\Concerns;

use App\Containers\Larabeans\Tenanter\Contracts\Tenant;

trait TenantRun
{
    /**
     * Run a callback in this tenant's context.
     * Atomic, safely reverts to previous context.
     *
     * @param callable $callback
     * @return mixed
     */
    public function run(callable $callback)
    {
        /** @var Tenant $this */
        $originalTenant = tenant();

        tenancy()->initializeTenant($this);
        $result = $callback($this);

        if ($originalTenant) {
            tenancy()->initializeTenant($originalTenant);
        } else {
            tenancy()->end();
        }

        return $result;
    }
}
