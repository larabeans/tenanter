<?php

namespace App\Containers\Larabeans\Tenanter\Models\Concerns;

use App\Containers\Larabeans\Tenanter\Contracts\Domain;

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
