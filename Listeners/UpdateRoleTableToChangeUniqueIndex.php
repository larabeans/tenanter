<?php

namespace App\Containers\Larabeans\Tenanter\Listeners;

use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRoleTableToChangeUniqueIndex
{
    public function __construct()
    {
    }

    public function handle(MigrationsEnded $event)
    {
        if (Schema::hasTable('roles')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->dropUnique(['name', 'guard_name']);
            });

            Schema::table('roles', function (Blueprint $table) {
                $table->unique(['name', 'guard_name', 'tenant_id']);
            });
        }
    }
}
