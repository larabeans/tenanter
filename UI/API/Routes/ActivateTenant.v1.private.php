<?php

/**
 * @apiGroup           Tenant
 * @apiName            activateTenant
 *
 * @api                {PATCH} /v1/tenant/:id/activate Activate Tenant
 * @apiDescription     Super admin, can activate any tenant for any possible reason.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User With Permissions
 *
 * @apiParam           {String}  id
 * @apiParam           {boolean}  status
 *
 * @apiUse             TenantSuccessSingleResponse
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('tenant/{id}/activate', [Controller::class, 'activateTenant'])
    ->name('api_tenant_activate_tenant')
    ->middleware(['auth:api']);
