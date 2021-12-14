<?php

/**
 * @apiGroup           Tenanter
 * @apiName            getDomainConfiguration
 *
 * @api                {GET} /v1/domains/configuration Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
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

Route::get('domain/configuration', [Controller::class, 'getDomainConfiguration'])
    ->name('api_tenanter_get_domain_configuration');

