<?php

namespace App\Containers\Vendor\Tenanter\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class TenantRepository
 */
class TenantRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        'name' => 'like',
        'domain' => 'like',
        'slug' => 'like'
    ];
}
