<?php

namespace App\Containers\Larabeans\Tenanter\Contracts;

/**
 * @see \App\Containers\Larabeans\Tenanter\Models\Business
 *
 * @method __call(string $method, array $parameters) IDE support. This will be a model.
 * @method static __callStatic(string $method, array $parameters) IDE support. This will be a model.
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface TenantDetail
{
    /** Get the name of the tenant. */
    public function getName(): string;

}
