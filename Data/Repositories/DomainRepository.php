<?php

namespace App\Containers\Vendor\Tenanter\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class DomainRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
