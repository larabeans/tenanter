<?php

/**
 * @apiGroup           Tenant
 * @apiName            verifyDomain
 *
 * @api                {PATCH} /v1/domain/:id/verify Verify Domain
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {Date}  verification_date
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('domain/{id}/verify', [Controller::class, 'verifyDomain'])
    ->name('api_tenanter_verify_domain')
    ->middleware(['auth:api']);

