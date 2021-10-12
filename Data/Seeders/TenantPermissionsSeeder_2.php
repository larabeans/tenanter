<?php

namespace App\Containers\Vendor\Tenanter\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Seeders\Seeder;

class TenantPermissionsSeeder_2 extends Seeder
{
    public function run()
    {
        // Default Tenant Management Permissions ----------------------------------------------------------
        app(CreatePermissionTask::class)->run('view-tenant', 'View Tenant Permissions.');
        app(CreatePermissionTask::class)->run('edit-tenant', 'Edit Tenant Permission.');
        app(CreatePermissionTask::class)->run('delete-tenant', 'Delete Tenant Permissions.');
        app(CreatePermissionTask::class)->run('create-tenant', 'Create Tenant Permission.');
    }
}
