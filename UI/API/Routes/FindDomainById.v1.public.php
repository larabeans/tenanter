<?php

/**
 * @apiGroup           Tenant
 * @apiName            findDomainById
 *
 * @api                {GET} /v1/domains/:id Find Domain By Id
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated user
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('domains/{id}', [Controller::class, 'findDomainById'])
    ->name('api_tenanter_find_domain_by_id')
    ->middleware(['auth:api']);

