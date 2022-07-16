<?php

namespace App\Containers\Larabeans\Tenanter\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTask;
use App\Ship\Parents\Seeders\Seeder;

class TenantDefaultUsersSeeder_4 extends Seeder
{
    public function run()
    {
        // Default Tenanter Admin (with their roles) ---------------------------------------------

        if (config('tenanter.default_id')) {
            $user = app(CreateUserByCredentialsTask::class)->run(
                $isClient = false,
                'tenant-admin@larabeans.com',
                'tenant',
                'Tenant Admin'
            )->assignRole(app(FindRoleTask::class)->run('tenant-admin'));

            if (config('locationer.installed')) {
                // User location
                app(CreateLocationTask::class)->run([
                    get_class($user),
                    $user->id,
                    'House #335, Street #17',
                    'Bla Bla Town, Phase 1',
                    85475, // Islamabad
                    3169,  // Islamabad Capital Territory
                    167,   // Pakistan
                    '0213 566',
                    '0.899656565',
                    '0.323565666'
                ]);
            }
        }
    }
}
