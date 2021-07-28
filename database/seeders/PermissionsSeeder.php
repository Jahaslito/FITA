<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'disable']);

        $superAdmin = Role::create(['name' => 'super_admin']);
        $superAdmin->givePermissionTo('edit', 'delete', 'disable');

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('edit');





    }
}
