<?php

namespace App\Containers\Larabeans\Tenanter\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Seeders\Seeder;

class TenantPermissionsSeeder_2 extends Seeder
{
    public function run()
    {
        // Default Tenant Management Permissions ----------------------------------------------------------
        app(CreatePermissionTask::class)->run('manage-tenant', 'Manage Tenant Permission.');
        app(CreatePermissionTask::class)->run('create-tenant', 'Create Tenant Permission.');
        app(CreatePermissionTask::class)->run('edit-tenant', 'Edit Tenant Permission.');
        app(CreatePermissionTask::class)->run('delete-tenant', 'Delete Tenant Permissions.');
        app(CreatePermissionTask::class)->run('view-tenant', 'View Tenant Permissions.');

        // Configurable Entities Permissions
        app(CreatePermissionTask::class)->run('edit-host-configuration', 'Edit Tenancy Host Level Configuration Permission.');
        app(CreatePermissionTask::class)->run('edit-tenant-configuration', 'Edit Tenancy Tenant Level Configuration Permission.');
        app(CreatePermissionTask::class)->run('edit-domain-configuration', 'Edit Tenancy Domain Level Configuration Permission.');
    }
}
