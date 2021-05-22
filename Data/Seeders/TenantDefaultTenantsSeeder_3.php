<?php

namespace App\Containers\Vendor\Tenanter\Data\Seeders;

use App\Containers\Vendor\Tenanter\Tasks\CreateTenantTask;
use App\Ship\Parents\Seeders\Seeder;

class TenantDefaultTenantsSeeder_3 extends Seeder
{
    public function run()
    {
      // Default Store Seeder ---------------------------------------------
      if(Config::get('tenanter.enabled')){
        app(CreateTenantTask::class)->run(
            config('tenanter.default_id'),
            'Default Tenant',
            $isActive = true
        );
      }
    }
}
