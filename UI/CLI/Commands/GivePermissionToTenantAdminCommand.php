<?php

namespace App\Containers\Vendor\Tenanter\UI\CLI\Commands;

use App\Containers\AppSection\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use Illuminate\Console\Command;

class GivePermissionToTenantAdminCommand extends Command
{
    protected $description = 'Give all permissions except in config(ignore.permissions) to tenant-admin. ';

    protected $signature = 'tenanter:permission:toRole';

    public function handle()
    {

        $finalPermissions = [];
        $ignorePermissions = config('tenanter.only-admin-permissions');
        $roleName = 'tenant-admin';
        $allPermissions = app(GetAllPermissionsTask::class)->run(true);

        foreach ($allPermissions as $permission) {
            if (!in_array($permission->name, $ignorePermissions)) {
                array_push($finalPermissions, $permission->name);
            }
        }

        $role = app(FindRoleTask::class)->run($roleName);

        if (!$role) {
            throw new RoleNotFoundException("Role $roleName is not found!");
        }

        $role->syncPermissions($finalPermissions);

        $this->info('Gave the Role (' . $roleName . ') the following Permissions: ' . implode(' - ',
                $finalPermissions) . '.');
    }
}
