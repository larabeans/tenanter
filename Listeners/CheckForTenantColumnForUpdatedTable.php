<?php

namespace App\Containers\Vendor\Tenanter\Listeners;

use Illuminate\Database\Events\MigrationEnded;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckForTenantColumnForUpdatedTable implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(MigrationEnded $event)
    {
        dd($event);
    }
}
