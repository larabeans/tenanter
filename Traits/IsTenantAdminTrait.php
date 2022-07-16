<?php

namespace App\Containers\Larabeans\Tenanter\Traits;

use Illuminate\Support\Facades\Auth;

trait IsTenantAdminTrait
{
    public function isTenantAdmin(): bool
    {
        return Auth::user()->hasRole('tenant-admin') && Auth::user()->tenant_id == tenant()->getTenantKey();
    }
}
