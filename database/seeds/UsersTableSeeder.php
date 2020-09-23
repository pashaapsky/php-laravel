<?php

namespace Database\Seeders;

use App\Permission;
use App\Post;
use App\Role;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $registeredRole = Role::where('slug', 'registered')->first();

        User::factory()
            ->has(Post::factory()
                ->has(Tag::factory()->count(random_int(0,2)))
                ->count(2))
            ->create([
                'name' => 'Pavel',
                'email' => 'admin@mail.ru',
                'password' => Hash::make('1')
            ])
            ->roles()->attach($adminRole)
        ;

        User::factory()
            ->has(Post::factory()
                ->has(Tag::factory()->count(random_int(0,2)))
                ->count(9))
            ->count(2)
            ->create()
            ->each(function (User $user) use ($registeredRole) {
                $user->roles()->attach($registeredRole);
            })
        ;

        $adminRole->permissions()->attach(Permission::all());
        $registeredRole->permissions()->attach(Permission::all());
    }
}
