<?php

namespace App\Containers\Vendor\Tenanter\Traits;

use Illuminate\Support\Facades\Auth;

trait IsTenantAdminTrait
{
    public function isTenantAdmin(string $tenant_id): bool
    {
        $user = Auth::user();

        if (sizeof($user->roles) == 0) {
            return false;
        } else {
            foreach ($user->roles as $role) {
                if ($role->name == "tenant-admin" && Auth::user()->tenant_id == $tenant_id) {
                    return true;
                }
            }
            return false;
        }
    }
}
