<?php

namespace App\Containers\Larabeans\Tenanter\Listeners;

use App\Containers\Larabeans\Tenanter\Events\RevertedToCentralContext;
use App\Containers\Larabeans\Tenanter\Events\RevertingToCentralContext;
use App\Containers\Larabeans\Tenanter\Events\TenancyEnded;

class RevertToCentralContext
{
    public function handle(TenancyEnded $event)
    {
        event(new RevertingToCentralContext($event->tenancy));

        foreach ($event->tenancy->getBootstrappers() as $bootstrapper) {
            $bootstrapper->revert();
        }

        event(new RevertedToCentralContext($event->tenancy));
    }
}
