<?php

/**
 * @apiGroup           Tenant
 * @apiName            getAllTenants
 *
 * @api                {GET} /v1/tenants Get All Tenant
 * @apiDescription     Api endpoint to get list of all tenants.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User, tenant-admin, view-tenant
 *
 *
 * @apiUse             TenantSuccessSingleResponse
 */

use App\Containers\Larabeans\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('tenants', [Controller::class, 'getAllTenants'])
    ->name('api_tenant_get_all_tenants')
    ->middleware(['auth:api']);
