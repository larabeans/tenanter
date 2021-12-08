<?php

namespace App\Containers\Vendor\Tenanter\Events\Contracts;

use Illuminate\Queue\SerializesModels;
use App\Ship\Parents\Events\Event;
use App\Containers\Vendor\Tenanter\Contracts\Domain;

abstract class DomainEvent extends Event
{
    use SerializesModels;

    /** @var Domain */
    public $domain;


    public Domain $entity;


    public function __construct(Domain $domain)
    {
        $this->domain = $domain;
        $this->entity = $domain;
    }


    /**
     * Get the channels the event should be broadcast on.
     */
    public function broadcastOn(): array
    {
        return [];
    }
}
