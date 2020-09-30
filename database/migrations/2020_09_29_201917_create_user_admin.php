<?php

use App\Permission;
use App\Role;
use App\User;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class CreateUserAdmin extends Migration
{
    public function up()
    {
        $permissionSeeder = new PermissionsTableSeeder();
        $permissionSeeder->run();

        $rolesSeeder = new RolesTableSeeder();
        $rolesSeeder->run();

        $adminRole = Role::where('slug', 'admin')->first();
        $adminPermissions = Permission::all();
        $adminRole->permissions()->attach($adminPermissions);

        $admin = User::factory()
            ->create([
                'name' => 'Pavel',
                'email' => 'admin@mail.ru',
                'password' => Hash::make('1')
            ]);

        $admin->roles()->attach($adminRole);
        $admin->permissions()->attach($adminPermissions);
    }

    public function down()
    {

    }
}
