<?php

namespace App\Containers\Vendor\Tenanter\Models\Concerns;

trait ConvertsDomainsToLowercase
{
    public static function bootConvertsDomainsToLowercase()
    {
        static::saving(function ($model) {
            $model->domain = strtolower($model->domain);
        });
    }
}
