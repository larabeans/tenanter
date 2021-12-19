<?php

namespace App\Containers\Vendor\Tenanter\Models;

use App\Containers\Vendor\Beaner\Parents\Models\Model;
use App\Containers\Vendor\Tenanter\Contracts;
use App\Containers\Vendor\Tenanter\Events;
use App\Containers\Vendor\Tenanter\Models\Concerns\HasInternalKeys;
use App\Containers\Vendor\Tenanter\Models\Concerns\HasDomains;

class Host extends Model implements Contracts\Host
{
    use HasInternalKeys, HasDomains;

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
    protected $resourceKey = 'hosts';

    public function getHostKeyName(): string
    {
        return 'id';
    }

    public function getHostKey()
    {
        return $this->getAttribute($this->getTenantKeyName());
    }

    protected $dispatchesEvents = [
        'saving' => Events\SavingHost::class,
        'saved' => Events\HostSaved::class,
        'creating' => Events\CreatingHost::class,
        'created' => Events\HostCreated::class,
        'updating' => Events\UpdatingHost::class,
        'updated' => Events\HostUpdated::class,
        'deleting' => Events\DeletingHost::class,
        'deleted' => Events\HostDeleted::class,
    ];
}
