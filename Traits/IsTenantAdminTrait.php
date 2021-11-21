<?php

namespace App\Containers\Vendor\Tenanter\Traits;

use Illuminate\Support\Facades\Auth;

trait IsTenantAdminTrait
{
    public function isTenantAdmin(string $tenantId): bool
    {
        return Auth::user()->hasRole('tenant-admin') && Auth::user()->tenant_id == $tenantId;
    }
}
