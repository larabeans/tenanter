<?php

namespace App\Containers\Vendor\Tenanter\Traits;

use Illuminate\Support\Facades\Auth;

trait IsTenantOwnerTrait
{
    public function isTenantOwner(): bool
    {
        return Auth::user()->hasRole('tenant-admin') && Auth::user()->tenant_id == $this->id;
    }
}
