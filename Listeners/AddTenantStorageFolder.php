<?php

namespace App\Containers\Vendor\Tenanter\Listeners;

use File;
use App\Containers\Vendor\Tenanter\Events\TenantCreated;

class AddTenantStorageFolder
{
    public function __construct()
    {
    }

    public function handle(TenantCreated $event)
    {
        $folderName ='tenant'.$event->tenant->id;
        File::makeDirectory(storage_path($folderName),0777);
        File::copy(storage_path('oauth-private.key'),storage_path($folderName.'/oauth-private.key'));
        File::copy(storage_path('oauth-public.key'),storage_path($folderName.'/oauth-public.key'));
        File::makeDirectory(storage_path($folderName).'/framework',0777);
        File::makeDirectory(storage_path($folderName.'/framework').'/cache',0777);
    }
}
