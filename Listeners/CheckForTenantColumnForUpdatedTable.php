<?php

namespace App\Containers\Vendor\Tenanter\Events\Handlers;

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
