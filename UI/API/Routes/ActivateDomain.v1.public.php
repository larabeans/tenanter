<?php

/**
 * @apiGroup           Tenanter
 * @apiName            activateDomain
 *
 * @api                {PATCH} /v1/domain/:id/activate Activate Domain
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated user
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

Route::patch('domain/{id}/activate', [Controller::class, 'activateDomain'])
    ->name('api_tenanter_activate_domain')
    ->middleware(['auth:api']);

