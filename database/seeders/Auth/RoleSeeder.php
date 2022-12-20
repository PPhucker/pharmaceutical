<?php

namespace Database\Seeders\Auth;

use App\Models\Auth\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run()
    {
        Role::create(
            [
                'name' => 'Administrator',
                'slug' => 'admin'
            ]
        );
    }
}
