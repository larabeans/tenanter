<?php

/**
 * @apiGroup           Tenant
 * @apiName            deactivateDomain
 *
 * @api                {PATCH} /v1/domain/:id/deactivate Deactivate Domain
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  id id of domain
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('domain/{id}/deactivate', [Controller::class, 'deactivateDomain'])
    ->name('api_tenanter_deactivate_domain')
    ->middleware(['auth:api']);

