<?php

namespace App\Containers\Vendor\Tenanter\Traits;

use Illuminate\Support\Facades\Auth;

trait IsTenantAdminTrait
{
    public function isTenantAdmin(string $tenant_id):bool
    {
        $user = Auth::user();

       // dd(app(GetAuthenticatedUserTask::class)->run());
        if ($user->roles[0]->name=="tenant-admin")
        {
            if(Auth::user()->tenant_id == $tenant_id){
                return true;
            }

        }
        return false;
    }


}
