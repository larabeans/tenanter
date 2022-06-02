<?php

namespace App\Containers\Vendor\Tenanter\Models;

//use Illuminate\Database\Eloquent\Model;
use App\Containers\Vendor\Beaner\Parents\Models\Model;
use App\Containers\Vendor\Configurationer\Traits\Configurable;
use App\Containers\Vendor\Tenanter\Contracts;
use App\Containers\Vendor\Tenanter\Events;
use App\Containers\Vendor\Tenanter\Tenant;
use App\Containers\Vendor\Tenanter\Models\Concerns\EnsuresDomainIsNotOccupied;
use App\Containers\Vendor\Tenanter\Models\Concerns\ConvertsDomainsToLowercase;
use App\Containers\Vendor\Tenanter\Models\Concerns\InvalidatesTenantsResolverCache;


class Domain extends Model implements Contracts\Domain
{
    use  ConvertsDomainsToLowercase, InvalidatesTenantsResolverCache, Configurable;

    protected $fillable = [
        'domain',
        'is_primary',
        'is_active',
        'is_verified',
        'verified_at',
        'dns_verification_hostname',
        'dns_verification_code',
        'domainable_id',
        'domainable_type'
    ];

    protected $guarded = [];

    public function domainable()
    {
        return $this->morphTo();
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
