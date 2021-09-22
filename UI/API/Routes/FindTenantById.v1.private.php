<?php

/**
 * @apiGroup           Tenant
 * @apiName            findTenantById
 *
 * @api                {GET} /v1/tenants/:id Find Tenant
 * @apiDescription     Api endpoint to get tenant details.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User, tenant-admin, view-tenant
 * @apiParam           {String}  id
 *
 * @apiUse             TenantSuccessSingleResponse
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('tenants/{id}', [Controller::class, 'findTenantById'])
    ->name('api_tenant_find_tenant_by_id')
    ->middleware(['auth:api']);
