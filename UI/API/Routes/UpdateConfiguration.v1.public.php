<?php

/**
 * @apiGroup           Tenant
 * @apiName            updateconfiguration
 *
 * @api                {PATCH} /v1/tenant/configurations Update Configuration
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {Object}  configuiration
 * @apiParam           {String}  type  tenant or domain
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('tenant/configurations', [Controller::class, 'updateConfiguration'])
    ->name('api_tenanter_updateconfiguration')
    ->middleware(['auth:api']);

