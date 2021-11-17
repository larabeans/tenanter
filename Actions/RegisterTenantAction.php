<?php

namespace App\Containers\Vendor\Tenanter\Actions;

use App\Containers\Vendor\Tenanter\Events\TenantRegisteredEvent;
use App\Containers\Vendor\Tenanter\Models\Tenant;
use App\Ship\Parents\Actions\Action;
use App\Containers\Vendor\Tenanter\Tasks\CreateTenantTask;
use App\Containers\Vendor\Tenanter\Tasks\CreateTenantUserTask;
use App\Containers\Vendor\Tenanter\UI\API\Requests\RegisterTenantRequest;

class RegisterTenantAction extends Action
{
    public function run(RegisterTenantRequest $request): Tenant
    {
        $tenant = app(CreateTenantTask::class)->run(null, $request->name, 0, $request->domain, 'active');
        $user = app(CreateTenantUserTask::class)->run(false, $tenant->id, $request->email, $request->password);
        TenantRegisteredEvent::dispatch($tenant);
        return $tenant;
    }
}
