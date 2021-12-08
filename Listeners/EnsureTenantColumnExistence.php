<?php

namespace App\Containers\Vendor\Tenanter\Listeners;

use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class EnsureTenantColumnExistence
{
    public function __construct()
    {
    }

    public function handle(MigrationsEnded $event)
    {
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            foreach ($table as $key => $name) {
                if (Config::get('tenanter.enabled') && !in_array($name, Config::get('tenanter.ignore_tables'))) {
                    Schema::table($name, function (Blueprint $t) {
                        if(Schema::hasColumn($t->getTable(), 'tenant_id') === false){
                            if (Schema::hasColumn($t->getTable(), 'id')) {
                                if (config('uuider.installed', false)) {
                                    $t->uuid('tenant_id')->after('id')->nullable();
                                } else {
                                    $t->integer('tenant_id')->after('id')->nullable();
                                }
                            } else {
                                if (config('uuider.installed', false)) {
                                    $t->uuid('tenant_id')->first()->nullable();
                                } else {
                                    $t->integer('tenant_id')->first()->nullable();
                                }
                            }
                        }
                    });
                }
            }
        }
    }
}
