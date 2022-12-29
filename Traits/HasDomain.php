<?php

namespace App\Containers\Larabeans\Tenanter\Traits;

use App\Containers\Larabeans\Tenanter\Models\Domain;

trait HasDomain
{
    /**
     * Get the entity's domain.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function domain()
    {
        return $this->morphOne(Domain::class, 'domainable')->orderBy('created_at', 'desc');
    }
}
