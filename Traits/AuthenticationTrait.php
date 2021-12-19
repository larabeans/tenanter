<?php

namespace App\Containers\Vendor\Tenanter\Traits;

use App\Containers\AppSection\User\Models\User;

trait AuthenticationTrait
{
    /**
     * Allows Passport to authenticate users with custom fields.
     * @param $identifier
     * @return User|null
     */
    public function findForPassport($identifier): ?User
    {
        $allowedLoginAttributes = config('appSection-authentication.login.attributes', ['email' => []]);

        $builder = $this;
        foreach (array_keys($allowedLoginAttributes) as $field) {
            $builder = $builder->orWhere($field, $identifier);
        }

        if(tenancy()->initialized && tenancy()->tenantInitialized && tenancy()->tenant) {
            $builder = $builder->where(config('tenanter.tenant_column'), tenant()->getTenantKey());
        }

        if(tenancy()->initialized && tenancy()->hostInitialized && tenancy()->host) {
            $builder = $builder->where(config('tenanter.tenant_column'), host()->getHostKey());
            $builder = $builder->orWhere(config('tenanter.tenant_column'), null);
        }

        return $builder->first();
    }
}
