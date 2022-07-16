<?php

namespace App\Containers\Larabeans\Tenanter\UI\CLI\Commands;

use App\Containers\AppSection\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Containers\Larabeans\Tenanter\Tasks\GetHostPrimaryDomainsTask;
use Illuminate\Console\Command;

class GiveAllExceptAdminOnlyPermissionToRoleCommand extends Command
{
    protected $signature = 'tenanter:permissions:toRole {role}';

    protected $description = 'Give all permissions except in config(tenanter.admin_only_permissions) to tenant admin role.';

    public function handle()
    {
        $roleName       = $this->argument('role') ?? 'tenant-admin';
        $all            = app(GetAllPermissionsTask::class)->run(true)->pluck('name')->toArray();
        $ignore         = config('tenanter.admin_only_permissions');
        $permissions    = array_diff($all, $ignore);;

        $role = app(FindRoleTask::class)->run($roleName);

        if (!$role) {
            throw new RoleNotFoundException("Role $roleName is not found!");
        }

        $role->syncPermissions($permissions);

        $this->info('Gave the Role (' . $roleName . ') the following Permissions: ' . implode(' - ',
                $permissions) . '.');
    }
}
