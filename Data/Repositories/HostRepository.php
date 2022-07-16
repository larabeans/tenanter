<?php

namespace App\Containers\Larabeans\Tenanter\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class HostRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
