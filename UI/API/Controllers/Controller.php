<?php

namespace App\Containers\Vendor\Tenanter\UI\API\Controllers;

use App\Containers\Vendor\Tenanter\UI\API\Requests\GetDomainConfigurationRequest;
use App\Containers\Vendor\Tenanter\Actions\ActivateDomainAction;
use App\Containers\Vendor\Tenanter\Actions\CreateDomainAction;
use App\Containers\Vendor\Tenanter\Actions\ChangeTenantModeAction;
use App\Containers\Vendor\Tenanter\Actions\DeactivateDomainAction;
use App\Containers\Vendor\Tenanter\Actions\DeleteDomainAction;
use App\Containers\Vendor\Tenanter\Actions\FindDomainByIdAction;
use App\Containers\Vendor\Tenanter\Actions\GetAllTenantDomainsAction;
use App\Containers\Vendor\Tenanter\Actions\GetDomainConfigurationAction;
use App\Containers\Vendor\Tenanter\Actions\GetTenantConfigurationAction;
use App\Containers\Vendor\Tenanter\Actions\UpdateConfigurationAction;
use App\Containers\Vendor\Tenanter\Actions\VerifyDomainAction;
use App\Containers\Vendor\Tenanter\Models\Domain;
use App\Containers\Vendor\Tenanter\UI\API\Requests\ActivateDomainRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\CreateDomainRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\ChangeTenantModeRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\DeactivateDomainRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\DeleteDomainRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\FindDomainByIdRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\GetAllTenantDomainsRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\GetTenantConfigurationRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\UpdateConfigurationRequest;
use App\Containers\Vendor\Tenanter\UI\API\Requests\VerifyDomainRequest;
use App\Containers\Vendor\Tenanter\UI\API\Transformers\DomainTransformer;
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

    // TODO: Purpose of this function
    public function createDomain(CreateDomainRequest $request)
    {
        $domain = app(CreateDomainAction::class)->run($request);
        return $this->transform($domain, DomainTransformer::class);
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
     * @param FindDomainByIdRequest $request
     * @return array
     */
    public function findDomainById(FindDomainByIdRequest $request)
    {
        $domain = app(FindDomainByIdAction::class)->run($request);

        return $this->transform($domain, DomainTransformer::class);
    }

    /**
     * @param FindDomainByIdRequest $request
     * @return array
     */
    public function verifyDomain(VerifyDomainRequest $request)
    {
        $domain = app(VerifyDomainAction::class)->run($request);

        return $this->transform($domain, DomainTransformer::class);
    }

    /**
     * @param ChangeTenantModeRequest $request
     * @return array
     */
    public function changeTenantMode(ChangeTenantModeRequest $request)
    {
        $tenant = app(ChangeTenantModeAction::class)->run($request);

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
     * @param GetTenantConfigurationRequest $request
     * @return array
     */
    public function getTenantConfiguration(GetTenantConfigurationRequest $request)
    {
        $tenants = app(GetTenantConfigurationAction::class)->run($request);

        return $tenants;
    }

    /**
     * @param GetDomainConfigurationRequest $request
     * @return array
     */
    public function getDomainConfiguration(GetDomainConfigurationRequest $request)
    {
        $tenants = app(GetDomainConfigurationAction::class)->run($request);

        return $tenants;
    }

    /**
     * @param GetAllTenantDomainsRequest $request
     * @return array
     */
    public function getAllTenantDomains(GetAllTenantDomainsRequest $request)
    {
        $domains = app(GetAllTenantDomainsAction::class)->run($request);

        return $this->transform($domains, DomainTransformer::class);
    }

    /**
     * @param ActivateDomainRequest $request
     * @return array
     */
    public function activateDomain(ActivateDomainRequest $request)
    {
        $domain = app(ActivateDomainAction::class)->run($request);

        return $this->transform($domain, DomainTransformer::class);
    }

    /**
     * @param ActivateDomainRequest $request
     * @return array
     */
    public function deactivateDomain(DeactivateDomainRequest $request)
    {
        $domain = app(DeactivateDomainAction::class)->run($request);

        return $this->transform($domain, DomainTransformer::class);
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
     * @param UpdateConfigurationRequest $request
     * @return array
     */
    public function updateConfiguration(UpdateConfigurationRequest $request)
    {
        $tenant = app(UpdateConfigurationAction::class)->run($request);

        return $tenant;
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

    /**
     * @param DeleteDomainRequest $request
     * @return null
     */
    public function deleteDomain(DeleteDomainRequest $request)
    {
        app(DeleteDomainAction::class)->run($request);

        return $this->noContent();
    }
}
