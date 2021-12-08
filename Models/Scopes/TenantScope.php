<?php

namespace App\Containers\Vendor\Tenanter\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (tenancy()->validTenantUser()) {

            if (tenancy()->validTable($model->getTable())) {
                if (! $this->gettingRolesForAuthenticatedUser($builder, $model)) {
                    $builder->where($model->qualifyColumn(config('tenanter.tenant_column')), tenant()->getTenantKey());
                }
            } else if ($model->getTable() == 'tenants') {
                // if table in context is `tenant`, apply tenant id check, so one tenant can only view its own tenant
                // if (! $this->gettingRolesForAuthenticatedUser($builder, $model)) {
                    $builder->where($model->qualifyColumn(tenant()->getTenantKeyName(), tenant()->getTenantKey()));
                // }
            }

        } else if (tenancy()->validHostUser()) {

            // Only return rows/data that don't belong to any tenant
            if (tenancy()->validTable($model->getTable())) {
                if (! $this->gettingRolesForAuthenticatedUser($builder, $model)) {
                    $builder->where($model->qualifyColumn(config('tenanter.tenant_column')), null);
                }
            }

        } else {
            return;
        }
    }

    public function extend(Builder $builder)
    {
        $builder->macro('withoutTenancy', function (Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });
    }

    // To exclude tenant check when getting data from roles and permissions for logged user
    private function gettingRolesForAuthenticatedUser($builder, $model): bool
    {
        if ($model->getTable() == 'roles') {
            $wheres = collect($builder->getQuery()->wheres);
            if (
                ($wheres->contains('column', 'model_has_roles.model_id') &&
                    $wheres->contains('column', 'model_has_roles.model_type') &&
                    $wheres->contains('value', 'App\Containers\Vendor\Beaner\Models\User')
                ) ||
                (
                $wheres->contains('column', 'role_has_permissions.permission_id')
                ) ||
                (
                $wheres->contains('column', 'id')
                )
            ) {
                return true;
            }
        }
        return false;
    }
}
