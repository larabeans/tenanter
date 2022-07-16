<?php

/**
 * @apiGroup           Tenant
 * @apiName            registerTenant
 *
 * @api                {POST} /v1/tenants/register Register Tenant
 * @apiDescription     Tenant is business Identity, api allows registration of tenant (i.e. business) identities.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  name unique
 * @apiParam           {String} email  user email(unique)
 * @apiParam           {String} password  user password
 *
 * @apiUse             TenantSuccessSingleResponse
 */

use App\Containers\Larabeans\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('tenants/register', [Controller::class, 'registerTenant'])
    ->name('api_tenant_create_tenant');
