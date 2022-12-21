<?php

namespace Database\Seeders\Auth;

use App\Models\Auth\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run()
    {
        Permission::create(
            [
                'name' => 'All permissions',
                'slug' => 'all'
            ]
        );
    }
}
