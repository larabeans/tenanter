<?php

namespace App\Containers\Vendor\Tenanter\Models\Concerns;

use App\Containers\Vendor\Tenanter\Contracts\Tenant;

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

        tenancy()->initialize($this);
        $result = $callback($this);

        if ($originalTenant) {
            tenancy()->initialize($originalTenant);
        } else {
            tenancy()->end();
        }

        return $result;
    }
}
