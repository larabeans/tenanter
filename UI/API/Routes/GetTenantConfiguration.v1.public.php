<?php

/**
 * @apiGroup           Tenant
 * @apiName            getTenantConfiguration
 *
 * @api                {GET} /v1/tenants/configuration Get Tenant Configuration
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('tenants/configuration', [Controller::class, 'getTenantConfiguration'])
    ->name('api_tenanter_get_tenant_configuration')
    ->middleware(['auth:api']);

