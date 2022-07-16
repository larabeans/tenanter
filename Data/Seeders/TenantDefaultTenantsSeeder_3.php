<?php

namespace App\Containers\Larabeans\Tenanter\Data\Seeders;

use App\Containers\Larabeans\Tenanter\Tasks\CreateTenantTask;
use App\Ship\Parents\Seeders\Seeder;

class TenantDefaultTenantsSeeder_3 extends Seeder
{
    public function run()
    {
        // Default Store Seeder ---------------------------------------------
        if (config('tenanter.default_id')) {
            app(CreateTenantTask::class)->run(
                config('tenanter.default_id'),
                'Default Tenant',
                $isActive = true,
                'www.defaulttenant.com',
                'active'
            );
        }
    }
}
