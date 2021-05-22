<?php

/**
 * @apiGroup           Tenant
 * @apiName            deleteTenant
 *
 * @api                {DELETE} /v1/tenants/:id Delete Tenant
 * @apiDescription     Api end point to delete tenant.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User With Permissions
 *
 *
 * @apiParam           {String}  id
 *
 * @apiUse             TenantSuccessSingleResponse
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('tenants/{id}', [Controller::class, 'deleteTenant'])
    ->name('api_tenant_delete_tenant')
    ->middleware(['auth:api']);
