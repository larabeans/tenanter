<?php

namespace App\Containers\Vendor\Tenanter\UI\CLI\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AddTenantToTableCommand extends Command
{
    protected $description = 'Add tenant id to given tables';

    protected $name = 'larabeans:db:add';

    private $result = [];

    public function handle()
    {
        $database = DB::select('SHOW TABLES');
        $tables = [];

        foreach ($database as $table) {
            array_push($tables, $table->Tables_in_lb_db);
        }
        // echo json_encode($tables)."\n";

        $data = $this->ask("enter a name or list on tables name separated by comma.<fg=magenta> eg: users,tenants");
        if ($data == null) {
            $this->line('<fg=red>' . "No Data Inserted");
        } else {
            $data = explode(",", $data);
            foreach ($data as $d) {
                if (in_array($d, $tables)) {
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

                //$this->info("id inserted successfully");
                } else {
                    //echo($d . " table nahi ha \n");
                    $this->line('<fg=red>' . $d . " table not found\n");
                }
            }
            if (!empty($this->result)) {
                $r = implode(",", $this->result);
                $this->line("<fg=green>" . "In tables " . $r . " tenant_id inserted");
            }
        }
    }

    //$this->line('<fg=black>Black <fg=red>Red <fg=green>Green <fg=yellow>Yellow
//             <fg=blue>Blue <fg=magenta>Magenta <fg=cyan>Cyan
//             <fg=white;bg=black>White <fg=default;bg=black>Default</>');
}
