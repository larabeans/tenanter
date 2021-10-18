<?php

/**
 * @apiGroup           Tenant
 * @apiName            createTenant
 *
 * @api                {POST} /v1/tenants Create Tenant
 * @apiDescription     Tenant is business Identity, api allows creation of tenant (i.e. business) identities by admin only.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User, tenant-admin, create-tenant
 *
 * @apiParam           {String}  name unique
 * @apiParam           {Binary} is_active 1 or 0
 * @apiParam           {String} domain  www.example.com
 * @apiParam           {String} mode active or passive
 *
 * @apiUse             TenantSuccessSingleResponse
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('tenants', [Controller::class, 'createTenant'])
    ->name('api_tenanter_create_tenant')
    ->middleware(['auth:api']);

