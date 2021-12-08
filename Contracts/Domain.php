<?php

namespace App\Containers\Vendor\Tenanter\Contracts;

/**
 * @property-read Tenant $tenant
 *
 * @see \App\Containers\Vendor\Tenanter\Models\Domain
 *
 * @method __call(string $method, array $parameters) IDE support. This will be a model.
 * @method static __callStatic(string $method, array $parameters) IDE support. This will be a model.
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface Domain
{
    public function tenant();
}
