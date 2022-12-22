<?php

namespace Database\Seeders;

use Database\Seeders\Auth\PermissionSeeder;
use Database\Seeders\Auth\RoleSeeder;
use Database\Seeders\Auth\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    final public function run()
    {
        $this->call(
            [
                RoleSeeder::class,
                PermissionSeeder::class,
                UserSeeder::class
            ]
        );
    }
}
