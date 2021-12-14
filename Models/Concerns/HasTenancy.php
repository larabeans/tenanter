<?php

namespace App\Containers\Vendor\Tenanter\Models\Concerns;

use App\Containers\Vendor\Tenanter\Models\Scopes\TenantScope;

/**
 * Trait HasTenancy.
 *
 * @author  Syed Ali Kazmi <ali@kazmi.me>
 */
trait HasTenancy
{
    public function tenant()
    {
        return $this->belongsTo(config('tenanter.models.tenant'), config('tenanter.tenant_column'));
    }

    public static function bootHasTenancy()
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            // Schema::hasColumn($model->getTable(), 'tenant_id')
            // Last check ensures to apply this only if route is public (i.e. no authenticated  required) or authenticated user is valid tenant user
            if (tenancy()->initialized && tenancy()->validTable($model->getTable()) && (!Auth::check() || tenancy()->validTenantUser())) {
                if (! $model->getAttribute(config('tenanter.tenant_column')) && ! $model->relationLoaded('tenant')) {
                    $model->setAttribute(config('tenanter.tenant_column'), tenant()->getTenantKey());
                    $model->setRelation('tenant', tenant());
                }
            }
        });

    }

}
