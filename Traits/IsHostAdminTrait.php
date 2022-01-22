<?php

namespace App\Containers\Vendor\Tenanter\Traits;

use Illuminate\Support\Facades\Auth;

trait IsHostAdminTrait
{
    public function isHostAdmin(): bool
    {
        return Auth::user()->hasAdminRole();
    }
}
