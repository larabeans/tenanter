<?php

namespace App\Containers\Vendor\Tenanter\UI\API\Controllers;

use App\Ship\Parents\Controllers\ApiController;
use App\Containers\Vendor\Tenanter\Actions\ActivateTenantAction;
use App\Containers\Vendor\Tenanter\Actions\RegisterTenantAction;
use App\Containers\Vendor\Tenanter\Actions\DeactivateTenantAction;
use App\Containers\Vendor\Tenanter\Actions\DeleteTenantAction;
use App\Containers\Vendor\Tenanter\Actions\FindTenantAction;
use App\Containers\Vendor\Tenanter\Actions\FindTenantByIdOrDomainNameAction;
use App\Containers\Vendor\Tenanter\Actions\GetAllTenantsAction;
use App\Containers\Vendor\Tenanter\Actions\UpdateTenantAction;
use App\Containers\Vendor\Tenanter\Actions\CreateTenantAction;
use App\Containers\Vendor\Tenanter\UI\API\Requests\ActivateTenantRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\CreateTenantRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\RegisterTenantRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\DeactivateTenantRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\DeleteTenantRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\GetAllTenantsRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\FindTenantByIdRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\FindTenantByIdOrDomainNameRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\UpdateTenantRequest;
use App\Containers\Vendor\Tenanter\UI\API\Transformers\TenantTransformer;

/**
 * Class Controller
 *
 * @package App\Containers\Vendor\Tenanter\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateTenantRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createTenant(CreateTenantRequest $request)
    {
        $tenant = app(CreateTenantAction::class)->run($request);
        return $this->created($this->transform($tenant, TenantTransformer::class));
    }

    /**
     * @param RegisterTenantRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerTenant(RegisterTenantRequest $request)
    {
        $tenant = app(RegisterTenantAction::class)->run($request);
        return $this->created($this->transform($tenant, TenantTransformer::class));
    }

    /**
     * @param FindTenantByIdOrDomainNameRequest $request
     * @return array
     */
    public function findTenantByIdOrDomainName(FindTenantByIdOrDomainNameRequest $request)
    {
        $tenant = app(FindTenantByIdOrDomainNameAction::class)->run($request);

        return $this->transform($tenant, TenantTransformer::class);
    }


    /**
     * @param GetAllTenantsRequest $request
     * @return array
     */
    public function getAllTenants(GetAllTenantsRequest $request)
    {
        $tenants = app(GetAllTenantsAction::class)->run($request);

        return $this->transform($tenants, TenantTransformer::class);
    }

    /**
     * @param UpdateTenantRequest $request
     * @return array
     */
    public function updateTenant(UpdateTenantRequest $request)
    {
        $tenant = app(UpdateTenantAction::class)->run($request);

        return $this->transform($tenant, TenantTransformer::class);
    }

    /**
     * @param DeleteTenantRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTenant(DeleteTenantRequest $request)
    {
        app(DeleteTenantAction::class)->run($request);

        return $this->noContent();
    }

    /**
     * @param ActivateTenantRequest $request
     * @return array
     */
    public function activateTenant(ActivateTenantRequest $request)
    {
        $tenant = app(ActivateTenantAction::class)->run($request);

        return $this->transform($tenant, TenantTransformer::class);
    }

    /**
     * @param DeactivateTenantRequest $request
     * @return array
     */
    public function deactivateTenant(DeactivateTenantRequest $request)
    {
        $tenant = app(DeactivateTenantAction::class)->run($request);

        return $this->transform($tenant, TenantTransformer::class);
    }
}
