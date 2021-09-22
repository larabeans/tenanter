<?php

/**
 * @apiGroup           Tenanter
 * @apiName            findTenantByDomain
 *
 * @api                {GET} /v1/domain/tenant Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User, tenant-admin, view-tenant
 *
 * @apiParam           {String}  domain name of domain eg. www.example.com
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Tenanter\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('domain/tenant', [Controller::class, 'findTenantByDomain'])
    ->name('api_tenanter_find_tenant_by_domain')
    ->middleware(['auth:api']);

