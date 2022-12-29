<?php

namespace App\Containers\Larabeans\Tenanter\Traits;

use App\Containers\Larabeans\Tenanter\Models\Domain;

trait HasDomains
{
    /**
     * Get the entity's domain.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function domains()
    {
        return $this->morphMany(Domain::class, 'domainable')->orderBy('created_at', 'desc');
    }
}
