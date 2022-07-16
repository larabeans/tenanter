<?php

namespace App\Containers\Larabeans\Tenanter\Listeners;

use Illuminate\Auth\Events\Authenticated;

class AuthenticatedListener
{
    public function __construct()
    {

    }

    public function handle(Authenticated $authenticated)
    {
        dd("hello world, listening event");
    }

}
