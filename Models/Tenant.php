<?php

namespace App\Containers\Vendor\Tenanter\Models;

use App\Containers\Vendor\Beaner\Parents\Models\Model;

class Tenant extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'is_active',
        'domain',
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
}
