<?php

namespace App\Containers\Larabeans\Tenanter\Listeners;

use App\Containers\Larabeans\Tenanter\Events\BootstrappingTenancy;
use App\Containers\Larabeans\Tenanter\Events\TenancyBootstrapped;
use App\Containers\Larabeans\Tenanter\Events\TenancyInitialized;

class BootstrapTenancy
{
    public function handle(TenancyInitialized $event)
    {
        if($event->tenancy->tenant){
            event(new BootstrappingTenancy($event->tenancy));

            foreach ($event->tenancy->getBootstrappers() as $bootstrapper) {
                $bootstrapper->bootstrap($event->tenancy->tenant);
            }

            event(new TenancyBootstrapped($event->tenancy));
        }
    }
}
