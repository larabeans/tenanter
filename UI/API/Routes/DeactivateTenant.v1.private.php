<?php

/**
 * @apiGroup           Tenant
 * @apiName            deactivateTenant
 *
 * @api                {PATCH} /v1/tenants/:id/deactivate Deactivate Tenant
 * @apiDescription     Super admin can deactivate tenant for any possible reason.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User, tenant-admin, edit-tenant
 *
 * @apiParam           {String}  id
 *
 * @apiUse             TenantSuccessSingleResponse
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('tenants/{id}/deactivate', [Controller::class, 'deactivateTenant'])
    ->name('api_tenants_deactivate_tenant')
    ->middleware(['auth:api']);
