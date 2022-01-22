<?php

namespace App\Containers\Vendor\Tenanter\Contracts;

/**
 * @see \App\Containers\Vendor\Tenanter\Models\Host
 *
 * @method __call(string $method, array $parameters) IDE support. This will be a model.
 * @method static __callStatic(string $method, array $parameters) IDE support. This will be a model.
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface Host
{
    /** Get the name of the key used for identifying the tenant. */
    public function getHostKeyName(): string;

    /** Get the value of the key used for identifying the tenant. */
    public function getHostKey();

    /** Get the value of an internal key. */
    public function getInternal(string $key);

    /** Set the value of an internal key. */
    public function setInternal(string $key, $value);
}
