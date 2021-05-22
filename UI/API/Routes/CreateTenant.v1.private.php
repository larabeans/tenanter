<?php

/**
 * @apiGroup           Tenant
 * @apiName            createTenant
 *
 * @api                {POST} /v1/tenants Create New Tenant
 * @apiDescription     Tenant is business Identity, api allows registration of tenant (i.e. business) identities.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  name
 *
 * @apiUse             TenantSuccessSingleResponse
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('tenants', [Controller::class, 'createTenant'])
    ->name('api_tenant_create_tenant')
    ->middleware(['auth:api']);
