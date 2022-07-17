<?php

/**
 * @apiGroup           Tenant
 * @apiName            deleteDomain
 *
 * @api                {DELETE} /v1/domains/:id  Delete Domain
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 OK
{
 * no content
}
 */

use App\Containers\Larabeans\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('domains/{id}', [Controller::class, 'deleteDomain'])
    ->name('api_tenanter_delete_domain')
    ->middleware(['auth:api']);

