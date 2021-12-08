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
        return $this->hasMany(config('tenanter.models.domain'), config('tenanter.tenant_column'));
    }

    public function createDomain($data): Domain
    {
        $class = config('tenanter.models.domain');

        if (! is_array($data)) {
            $data = ['domain' => $data];
        }

        $domain = (new $class)->fill($data);
        $domain->tenant()->associate($this);
        $domain->save();

        return $domain;
    }
}
