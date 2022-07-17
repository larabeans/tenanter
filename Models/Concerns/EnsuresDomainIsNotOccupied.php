<?php

namespace App\Containers\Larabeans\Tenanter\Models\Concerns;

use App\Containers\Larabeans\Tenanter\Exceptions\DomainOccupiedByOtherTenantException;

trait EnsuresDomainIsNotOccupied
{
    public static function bootEnsuresDomainIsNotOccupied()
    {
        static::saving(function ($self) {
            if ($domain = $self->newQuery()->where('domain', $self->domain)->first()) {
                if ($domain->getKey() !== $self->getKey()) {
                    throw new DomainOccupiedByOtherTenantException($self->domain);
                }
            }
        });
    }
}
