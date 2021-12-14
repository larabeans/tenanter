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

        if(tenancy()->initialized) {
            $builder = $builder->where(config('tenanter.tenant_column'), tenant()->getTenantKey());
        }

        return $builder->first();
    }
}
