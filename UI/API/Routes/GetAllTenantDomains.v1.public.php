<?php

/**
 * @apiGroup           Tenanter
 * @apiName            getAllTenantDomains
 *
 * @api                {GET} /v1/tenant/{id}/domains Get All Tenant Domains
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  id  tenant_id
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('tenant/{id}/domains', [Controller::class, 'getAllTenantDomains'])
    ->name('api_tenanter_get_all_tenant_domains')
    ->middleware(['auth:api']);

