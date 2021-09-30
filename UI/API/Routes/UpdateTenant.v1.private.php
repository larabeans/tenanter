<?php

/**
 * @apiGroup           Tenant
 * @apiName            updateTenant
 *
 * @api                {PATCH} /v1/tenants/:id Update Tenant
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User, tenant-admin, edit-tenant
 *
 * @apiParam           {String}  name
 * @apiParam           {String}  status
 *
 * @apiUse             TenantSuccessSingleResponse
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('tenants/{id}', [Controller::class, 'updateTenant'])
    ->name('api_tenant_update_tenant')
    ->middleware(['auth:api']);
