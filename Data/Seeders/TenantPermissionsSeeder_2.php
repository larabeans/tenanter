<?php

namespace App\Containers\Larabeans\Tenanter\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Seeders\Seeder;

class TenantPermissionsSeeder_2 extends Seeder
{
    public function run()
    {
        foreach (array_keys(config('auth.guards')) as $guardName) {
            // Default Tenant Management Permissions ----------------------------------------------------------
            app(CreatePermissionTask::class)->run('manage-tenant', 'Manage Tenant Permission.', guardName: $guardName);
            app(CreatePermissionTask::class)->run('create-tenant', 'Create Tenant Permission.', guardName: $guardName);
            app(CreatePermissionTask::class)->run('edit-tenant', 'Edit Tenant Permission.', guardName: $guardName);
            app(CreatePermissionTask::class)->run('delete-tenant', 'Delete Tenant Permissions.', guardName: $guardName);
            app(CreatePermissionTask::class)->run('view-tenant', 'View Tenant Permissions.', guardName: $guardName);

            // Configurable Entities Permissions
            app(CreatePermissionTask::class)->run('edit-host-configuration', 'Edit Tenancy Host Level Configuration Permission.', guardName: $guardName);
            app(CreatePermissionTask::class)->run('edit-tenant-configuration', 'Edit Tenancy Tenant Level Configuration Permission.', guardName: $guardName);
            app(CreatePermissionTask::class)->run('edit-domain-configuration', 'Edit Tenancy Domain Level Configuration Permission.', guardName: $guardName);
        }
    }
}
