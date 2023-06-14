<?php

namespace Database\Seeders\Auth;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run()
    {
        $admin = User::create(
            [
                'name' => 'Administrator',
                'email' => config('seeder.email', 'user@pharmaceutical.com'),
                'password' => Hash::make(config('seeder.password', 'password')),
                'email_verified_at' => Carbon::now()
            ]
        );

        $admin->roles()->attach(
            Role::where('slug', 'admin')->first()
        );

        $admin->permissions()->attach(
            Permission::where('slug', 'all')->first()
        );
    }
}
