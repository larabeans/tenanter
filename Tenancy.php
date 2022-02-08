<?php

namespace App\Containers\Vendor\Tenanter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Traits\Macroable;

use App\Containers\Vendor\Tenanter\Events;
use App\Containers\Vendor\Tenanter\Contracts\Host;
use App\Containers\Vendor\Tenanter\Contracts\Tenant;
use App\Containers\Vendor\Tenanter\Contracts\TenancyBootstrapper;
use App\Containers\Vendor\Tenanter\Exceptions\HostCouldNotBeIdentifiedById;
use App\Containers\Vendor\Tenanter\Exceptions\TenantCouldNotBeIdentifiedById;

class Tenancy
{
    use Macroable;

    /** @var Host|Model|null */
    public $host;

    /** @var Tenant|Model|null */
    public $tenant;

    /** @var Domain|Model|null */
    public $domain;

    /** @var bool */
    public $initialized = false;

    /** @var bool */
    public $hostInitialized = false;

    /** @var bool */
    public $tenantInitialized = false;

    /** @var callable|null */
    public $getBootstrappersUsing = null;

    /**
     * Initializes the host.
     * @param Host|int|string $host
     * @return void
     */
    public function initializeHost($host): void
    {
        if (! is_object($host)) {
            $hostId = $host;
            $host = $this->findHost($hostId);

            if (! $host) {
                throw new HostCouldNotBeIdentifiedById($hostId);
            }
        }

        // host is same, as already initialized
        if ($this->initialized && $this->hostInitialized && $this->host->getHostKey() === $host->getHostKey()) {
            return;
        }

        // This will end tenancy with old tenant & will use to revert to host context
        // if ($this->hostInitialized) {
        //     $this->end();
        // }

        $this->host = $host;

        event(new Events\InitializingTenancy($this));

        $this->initialized = true;
        $this->hostInitialized = true;

        event(new Events\TenancyInitialized($this));
    }

    /**
     * Initializes the tenant.
     * @param Tenant|int|string $tenant
     * @return void
     */
    public function initializeTenant($tenant): void
    {
        if (! is_object($tenant)) {
            $tenantId = $tenant;
            $tenant = $this->findTenant($tenantId);

            if (! $tenant) {
                throw new TenantCouldNotBeIdentifiedById($tenantId);
            }
        }

        // tenant is same, as already initialized
        if ($this->initialized && $this->tenantInitialized && $this->tenant->getTenantKey() === $tenant->getTenantKey()) {
            return;
        }

        // This will end tenancy
        // will use to revert to host context
        if ($this->tenantInitialized) {
            $this->end();
        }

        $this->tenant = $tenant;

        event(new Events\InitializingTenancy($this));

        $this->initialized = true;
        $this->tenantInitialized = true;

        event(new Events\TenancyInitialized($this));
    }


    public function end(): void
    {
        event(new Events\EndingTenancy($this));

        if (! $this->initialized && ! $this->tenantInitialized) {
            return;
        }

        $this->initialized = false;
        $this->tenantInitialized = false;

        event(new Events\TenancyEnded($this));

        $this->tenant = null;
    }

    /** @return TenancyBootstrapper[] */
    public function getBootstrappers(): array
    {
        // If no callback for getting bootstrappers is set, we just return all of them.
        $resolve = $this->getBootstrappersUsing ?? function () {
                return config('tenanter.bootstrappers');
            };

        // Here We instantiate the bootstrappers and return them.
        return array_map('app', $resolve($this->tenant));
    }

    public function findTenant($id): ?Tenant
    {
        return $this->model('tenant')->where($this->model('tenant')->getTenantKeyName(), $id)->first();
    }

    public function findHost($id): ?Host
    {
        return $this->model('host')->where($this->model('host')->getHostKeyName(), $id)->first();
    }

    public function query($key): Builder
    {
        return $this->model($key)->query();
    }

    public function model($key)
    {
        $class = config('tenanter.models.' . $key);

        return new $class;
    }

    public function validTable($table): bool
    {
        return ! in_array($table, config('tenanter.ignore_tables'));
    }

    public function  isValidHostAdmin(): bool
    {
        // using guard implicitly, not sure it is added at middleware level
        return Auth::guard('api')->check() && Auth::guard('api')->user()->hasAdminRole() && $this->host && $this->host->getHostKey() === Auth::guard('api')->user()->tenant_id;
    }

    public function  isValidHostUser(): bool
    {
        return Auth::check() && $this->host && $this->host->getHostKey() === Auth::user()->tenant_id;
    }

    public function  isValidTenantAdmin(): bool
    {
        // using guard implicitly, not sure it is added at middleware level
        return Auth::guard('api')->check() && Auth::guard('api')->user()->hasRole('tenant-admin') && $this->tenant && $this->tenant->getTenantKey() === Auth::guard('api')->user()->tenant_id;
    }

    public function  isValidTenantUser(): bool
    {
        return Auth::check() && $this->tenant && $this->tenant->getTenantKey() === Auth::user()->tenant_id;
    }

    public function side() {
        $sides = config('tenanter.tenancy.sides');
        if($this->initialized) {
            return $this->hostInitialized ? $sides['HOST'] : $sides['TENANT'];
        }
        return null;
    }
}
