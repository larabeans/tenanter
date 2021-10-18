<?php

/**
 * @apiGroup           Tenant
 * @apiName            registerTenant
 *
 * @api                {POST} /v1/tenants Register Tenant
 * @apiDescription     Tenant is business Identity, api allows registration of tenant (i.e. business) identities.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  name unique
 * @apiParam           {Binary} is_active 1 or 0
 * @apiParam           {String} domain  www.example.com
 * @apiParam           {String} email  user email(unique)
 * @apiParam           {String} password  user password
 * @apiParam           {String} mode active or passive
 *
 * @apiUse             TenantSuccessSingleResponse
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('register/tenants', [Controller::class, 'registerTenant'])
    ->name('api_tenant_create_tenant')
    ->middleware(['auth:api']);
