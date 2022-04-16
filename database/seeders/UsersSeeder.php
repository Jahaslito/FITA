<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testSuperAdmin = new User();
        $testSuperAdmin->first_name = "Test";
        $testSuperAdmin->last_name = "superAdmin";
        $testSuperAdmin->email = "super.admin@test.io";
        $testSuperAdmin->password = bcrypt('12345678');
        $testSuperAdmin->assignRole('super_admin');
        $testSuperAdmin->save();

        $admin = new User();
        $admin->first_name = "Test";
        $admin->last_name = "Admin";
        $admin->email = "admin@test.io";
        $admin->password = bcrypt('12345678');
        $admin->assignRole('admin');
        $admin->save();

        $user = new User();
        $user->first_name = "Test";
        $user->last_name = "user";
        $user->email = "user@test.io";
        $user->password = bcrypt('12345678');
        $user->save();



    }
}
