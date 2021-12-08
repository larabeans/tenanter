<?php

namespace App\Containers\Vendor\Tenanter\Contracts;

interface TenantResolver
{
    /**
     * Resolve a tenant using some value.
     *
     * @throws TenantCouldNotBeIdentifiedException
     */
    public function resolve(...$args): ?Tenant;
}
