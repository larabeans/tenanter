<?php

namespace App\Containers\Vendor\Tenanter\UI\CLI\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AddIdToAllCommand extends Command
{
    protected $description = 'Add tenant id to tables';

    protected $name = 'larabeans:db:all';

    private $result = [];

    public function handle()
    {
        $database = DB::select('SHOW TABLES');
        $tables = [];

        foreach ($database as $table) {
            array_push($tables, $table->Tables_in_lb_db);
        }

        $configData = Config::get('tenanter.ignore_tables');

        foreach ($tables as $d) {
            if (!in_array($d, $configData)) {
                Schema::table($d, function (Blueprint $t) {
                    if (Schema::hasColumn($t->getTable(), 'tenant_id')) {
                        $this->line('<fg=red>' . $t->getTable() . " has tenant_id already exists");

                    } else {
                        if (Schema::hasColumn($t->getTable(), 'id')) {
                            if (config('uuider.installed', false)) {
                                $t->uuid('tenant_id')->after('id')->index('tenant_id')->nullable();
                                array_push($this->result, $t->getTable());
                            } else {
                                $t->integer('tenant_id')->after('id')->index('tenant_id')->nullable();
                                array_push($this->result, $t->getTable());
                            }

                        } else {
                            if (config('uuider.installed', false)) {
                                $t->uuid('tenant_id')->first()->index('tenant_id')->nullable();
                                array_push($this->result, $t->getTable());
                            } else {
                                $t->integer('tenant_id')->first()->index('tenant_id')->nullable();
                                array_push($this->result, $t->getTable());
                            }
                        }
                    }

                });


            }
        }
        if (!empty($this->result)) {
            $r = implode(",", $this->result);
            $this->line("<fg=green>" . "In tables (" . $r . ") tenant_id inserted");
        }
        //}
    }

//$this->line('<fg=black>Black <fg=red>Red <fg=green>Green <fg=yellow>Yellow
//             <fg=blue>Blue <fg=magenta>Magenta <fg=cyan>Cyan
//             <fg=white;bg=black>White <fg=default;bg=black>Default</>');
}
