<?php

/**
 * @apiGroup           Tenant
 * @apiName            deactivateTenant
 *
 * @api                {PATCH} /v1/tenant/:id/deactivate Deactivate Tenant
 * @apiDescription     Super admin can deactivate tenant for any possible reason.
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

Route::patch('tenant/{id}/deactivate', [Controller::class, 'deactivateTenant'])
    ->name('api_tenant_deactivate_tenant')
    ->middleware(['auth:api']);
