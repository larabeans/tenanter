<?php

/**
 * @apiGroup           Tenant
 * @apiName            changeTenantMode
 *
 * @api                {PATCH} /v1/tenants/:id/mode Change Tenant Mode
 * @apiDescription     Change the mode of tenant
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated user, admin
 *
 * @apiParam           {String}  mode active/passive
 *
 * @apiUse             TenantSuccessSingleResponse
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('tenants/{id}/mode', [Controller::class, 'changeTenantMode'])
    ->name('api_tenanter_change_tenant_mode')
    ->middleware(['auth:api']);

