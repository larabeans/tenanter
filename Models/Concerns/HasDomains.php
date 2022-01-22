<?php

namespace App\Containers\Vendor\Tenanter\Models\Concerns;

use App\Containers\Vendor\Tenanter\Contracts\Domain;

/**
 * @property-read Domain[]|\Illuminate\Database\Eloquent\Collection $domains
 */
trait HasDomains
{
    public function domains()
    {
        //$this->hasMany(config('tenanter.models.domain'), config('tenanter.tenant_column'));
        return $this->morphMany(config('tenanter.models.domain'), 'domainable')->orderBy('created_at', 'desc');
    }

}
