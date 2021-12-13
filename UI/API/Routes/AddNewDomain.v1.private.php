<?php

/**
 * @apiGroup           Tenant
 * @apiName            addNewDomain
 *
 * @api                {POST} /v1/domains Add New Domain
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  domain
 *
 * @apiSuccessExample  {String}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('domains', [Controller::class, 'addNewDomain'])
    ->name('api_tenanter_add_new_domain')
    ->middleware(['auth:api']);

