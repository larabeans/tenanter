<?php

namespace App\Containers\Vendor\Tenanter\Data\Seeders;

use App\Containers\Vendor\Tenanter\Tasks\CreateTenantTask;
use App\Ship\Parents\Seeders\Seeder;

class TenantDefaultTenantsSeeder_3 extends Seeder
{
    public function run()
    {
        // Default Store Seeder ---------------------------------------------
        app(CreateTenantTask::class)->run(
            config('tenanter.default_id'),
            'Default Tenant',
            $isActive = true,
            'www.defaulttenant.com',
            "{'language':'English','currency':'pkr'}"
        );
    }
}
