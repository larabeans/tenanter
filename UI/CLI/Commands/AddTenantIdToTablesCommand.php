<?php

namespace App\Containers\Vendor\Tenanter\UI\CLI\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AddTenantIdToTablesCommand extends Command
{
    protected $description = 'Add tenant id to given tables';

    protected $signature = 'tenanter:db:update {type}';

    private $result = [];

    private $tables = [];

    public function handle()
    {
        $database = DB::select('SHOW TABLES');

        foreach ($database as $table) {
            foreach ($table as $key => $name) {
                if (!in_array($name, Config::get('tenanter.ignore_tables'))) {
                    array_push($this->tables, $name);
                }
            }
        }

        if ($this->argument('type') == 'all') {
            $responseData = implode("\n\r- ", $this->tables);
            $ans = $this->confirm("<fg=magenta>" . $responseData . "\n<fg=yellow> In above tables you wanted to insert tenant_id ?");
            if ($ans == 0) {
                $this->line("<fg=green>" . "command exits");
            } else {
                foreach ($this->tables as $name) {
                    $this->addTenantId($name);
                }
            }
        } elseif ($this->argument('type') == 'list') {
            $data = $this->ask("enter a name or list of tables name separated by comma.<fg=magenta> eg: users,tenants");
            if ($data == null) {
                $this->line('<fg=red>' . "No Data Entered");
            } else {
                $data = explode(",", $data);
                foreach ($data as $name) {
                    if (in_array($name, $this->tables)) {
                        $this->addTenantId($name);
                    } else {
                        $this->line('<fg=red>' . $name . " table not found\n");
                    }
                }
            }
        }

        if (!empty($this->result)) {
            $responseData = implode("\n\t- ", $this->result);
            $this->line("<fg=green>" . $responseData . "\n Above tables tenant_id inserted");
        }
    }

    public function addTenantId($name)
    {
        Schema::table($name, function (Blueprint $t) {
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
