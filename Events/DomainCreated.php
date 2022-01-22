<?php

namespace App\Containers\Vendor\Tenanter\Events;

use App\Containers\Vendor\Tenanter\Contracts\Domain;

class DomainCreated extends Contracts\DomainEvent
{
    public function __construct(Domain $domain)
    {
        parent::__construct($domain);
    }
}
