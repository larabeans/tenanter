<?php

namespace App\Containers\Vendor\Tenanter\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTask;
use App\Ship\Parents\Seeders\Seeder;

class TenantDefaultUsersSeeder_4 extends Seeder
{
    public function run()
    {
        // Default Store Admin (with their roles) ---------------------------------------------
        $user = app(CreateUserByCredentialsTask::class)->run(
            $isClient = false,
            'tenant-admin@larabeans.com',
            'tenant',
            'Tenant Admin',
        )->assignRole(app(FindRoleTask::class)->run('tenant-admin'));

        // User location
        //        app('Location@CreateLocationTask', [
        //            get_class($user),
        //            $user->id,
        //            'House #335, Street #17',
        //            'Bla Bla Town, Phase 1',
        //            85475, // Islamabad
        //            3169,  // Islamabad Capital Territory
        //            167,   // Pakistan
        //            '0213 566',
        //            '0.899656565',
        //            '0.323565666'
        //        ]);
    }
}
