<?php

namespace App\Containers\Vendor\Tenanter\Models;

use Illuminate\Database\Eloquent\Model;
use App\Containers\Vendor\Tenanter\Contracts;
use App\Containers\Vendor\Tenanter\Events;
use App\Containers\Vendor\Tenanter\Tenant;
use App\Containers\Vendor\Tenanter\Models\Concerns\EnsuresDomainIsNotOccupied;
use App\Containers\Vendor\Tenanter\Models\Concerns\ConvertsDomainsToLowercase;
use App\Containers\Vendor\Tenanter\Models\Concerns\InvalidatesTenantsResolverCache;


/**
 * @property string $domain
 * @property string $tenant_id
 *
 * @property-read Tenant|Model $tenant
 */
class Domain extends Model implements Contracts\Domain
{
    use EnsuresDomainIsNotOccupied, ConvertsDomainsToLowercase, InvalidatesTenantsResolverCache;

    protected $guarded = [];

    public function tenant()
    {
        return $this->belongsTo(config('tenanter.models.tenant'));
    }

    protected $dispatchesEvents = [
        'saving' => Events\SavingDomain::class,
        'saved' => Events\DomainSaved::class,
        'creating' => Events\CreatingDomain::class,
        'created' => Events\DomainCreated::class,
        'updating' => Events\UpdatingDomain::class,
        'updated' => Events\DomainUpdated::class,
        'deleting' => Events\DeletingDomain::class,
        'deleted' => Events\DomainDeleted::class,
    ];
}