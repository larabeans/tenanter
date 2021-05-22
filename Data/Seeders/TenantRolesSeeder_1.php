<?php

namespace App\Containers\Vendor\Tenanter\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;
use App\Ship\Parents\Seeders\Seeder;

class TenantRolesSeeder_1 extends Seeder
{
    public function run()
    {
      // Default Tenant Roles ----------------------------------------------------------------
      app(CreateRoleTask::class)->run('tenant-admin', 'Tenant Administrator', 'Administrator Role', 999);
    }
}
