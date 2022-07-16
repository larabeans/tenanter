<?php

namespace App\Containers\Larabeans\Tenanter\Models;

use App\Containers\Larabeans\Beaner\Parents\Models\Model;
use App\Containers\Larabeans\Configurationer\Traits\Configurable;
use App\Containers\Larabeans\Tenanter\Contracts;
use App\Containers\Larabeans\Tenanter\Events;
use App\Containers\Larabeans\Tenanter\Models\Concerns\HasInternalKeys;
use App\Containers\Larabeans\Tenanter\Models\Concerns\InvalidatesResolverCache;
use App\Containers\Larabeans\Tenanter\Models\Concerns\TenantRun;
use App\Containers\Larabeans\Tenanter\Models\Concerns\HasDomains;

class Tenant extends Model implements Contracts\Tenant
{
    use HasInternalKeys, TenantRun, InvalidatesResolverCache, HasDomains, Configurable;

    protected $fillable = [
        'slug',
        'name',
        'is_active',
        'domain',
        'mode'
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [
        'configuration' => 'string'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'tenants';

    public function getTenantKeyName(): string
    {
        return 'id';
    }

    public function getTenantKey()
    {
        return $this->getAttribute($this->getTenantKeyName());
    }

    protected $dispatchesEvents = [
        'saving' => Events\SavingTenant::class,
        'saved' => Events\TenantSaved::class,
        'creating' => Events\CreatingTenant::class,
        'created' => Events\TenantCreated::class,
        'updating' => Events\UpdatingTenant::class,
        'updated' => Events\TenantUpdated::class,
        'deleting' => Events\DeletingTenant::class,
        'deleted' => Events\TenantDeleted::class,
    ];
}
