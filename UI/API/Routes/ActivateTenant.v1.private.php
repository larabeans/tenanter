<?php

/**
 * @apiGroup           Tenant
 * @apiName            activateTenant
 *
 * @api                {PATCH} /v1/tenants/:id/activate Activate Tenant
 * @apiDescription     Super admin, can activate any tenant for any possible reason.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User, tenant-admin, edit-tenant
 *
 * @apiParam           {String}  id
 *
 * @apiUse             TenantSuccessSingleResponse
 */

use App\Containers\Larabeans\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('tenants/{id}/activate', [Controller::class, 'activateTenant'])
    ->name('api_tenant_activate_tenant')
    ->middleware(['auth:api']);
