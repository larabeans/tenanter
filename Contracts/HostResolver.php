<?php

namespace App\Containers\Larabeans\Tenanter\Contracts;

interface HostResolver
{
    /**
     * Resolve a tenant using some value.
     *
     * @throws HostCouldNotBeIdentifiedException
     */
    public function resolve(...$args): ?Host;
}
