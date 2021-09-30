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
        $c = $entity->configuration;
        $response = [
            'object' => 'Tenant',
            'id' => $entity->id,
            'name' => $entity->name,
            'slug' => $entity->slug,
            'domain' => $entity->domain,
            'is_active' => $entity->is_active,
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
