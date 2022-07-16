<?php

namespace App\Containers\Larabeans\Tenanter\Listeners;

use App\Containers\AppSection\Authorization\Tasks\GetAllRolesTask;
use App\Containers\Larabeans\Tenanter\Events\HostCreated;
use App\Containers\Larabeans\Tenanter\Tasks\UpdateRoleTask;

class SetupTenantIdForDefaultRoles
{
    public function __construct()
    {
    }

    public function handle(HostCreated $event)
    {
        $roles = app(GetAllRolesTask::class)->run(true);
        foreach ($roles as $role) {
            if (($role->name == 'tenant-admin' || $role->name == 'admin') && $role->tenant_id == null) {
                app(UpdateRoleTask::class)->run($role->id, ['tenant_id' => $event->host->id]);
            }
        }
    }
}
