<?php

namespace App\Containers\Vendor\Tenanter\UI\API\Transformers;

use App\Containers\Vendor\Tenanter\Models\Tenant;
use App\Ship\Parents\Transformers\Transformer;

class TenantTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * @param Tenant $entity
     *
     * @return array
     */
    public function transform(Tenant $entity)
    {
        $response = [
            'object' => 'Tenant',
            'id' => $entity->getHashedKey(),
            'name' => $entity->name,
            'display_name' => $entity->display_name,
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,

        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
            'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
