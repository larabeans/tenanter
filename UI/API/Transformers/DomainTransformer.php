<?php

namespace App\Containers\Vendor\Tenanter\UI\API\Transformers;

use App\Containers\Vendor\Tenanter\Models\Domain;
use App\Ship\Parents\Transformers\Transformer;

class DomainTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected array $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected array $availableIncludes = [

    ];

    public function transform(Domain $domain): array
    {
        $response = [
            'object' => $domain->getResourceKey(),
            'id' => $domain->id,
            'tenant_id' => $domain->tenant_id,
            'domain' => $domain->domain,
            'is_primary' => $domain->is_primary,
            'is_active' => $domain->is_active,
            'is_verified' => $domain->is_verified,
            'dns_verification_hostname' => $domain->dns_verification_hostname,
            'dns_verification_code' => $domain->dns_verification_code,
            'verified_at' => $domain->verified_at,
            'created_at' => $domain->created_at,
            'updated_at' => $domain->updated_at,
            'deleted_at' => $domain->deleted_at,
            'readable_created_at' => $domain->created_at->diffForHumans(),
            'readable_updated_at' => $domain->updated_at->diffForHumans(),

        ];

        return $response = $this->ifAdmin([
            'real_id'    => $domain->id,
            // 'deleted_at' => $domain->deleted_at,
        ], $response);
    }
}
