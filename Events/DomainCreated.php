<?php

namespace App\Containers\Larabeans\Tenanter\Events;

use App\Containers\Larabeans\Tenanter\Contracts\Domain;

class DomainCreated extends Contracts\DomainEvent
{
    public function __construct(Domain $domain)
    {
        parent::__construct($domain);
    }
}
