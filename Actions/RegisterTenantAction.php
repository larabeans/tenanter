<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\AppSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\Vendor\Tenanter\Events\TenantCreated;
use App\Containers\Vendor\Tenanter\Models\Tenant;
use App\Ship\Parents\Actions\Action;
use App\Containers\Vendor\Tenanter\Tasks\CreateTenantTask;
use App\Containers\Vendor\Tenanter\Tasks\CreateUserTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\RegisterTenantRequest;

class RegisterTenantAction extends Action
{
    public function run(RegisterTenantRequest $request): Tenant
    {
        $tenant = app(CreateTenantTask::class)->run(null, $request->name, 0, 'active');
        $user = app(CreateUserTask::class)->run(false, $tenant->id, $request->email, $request->password);
        $role = app(FindRoleTask::class)->run('tenant-admin');

        if ($role !== null) {
            app(AssignRolesToUserTask::class)->run($user, [$role]);
        }

        return $tenant;
    }
}
