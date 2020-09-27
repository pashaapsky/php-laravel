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
        $adminPermissions = Permission::all();

        $registeredPermissions = ['view-posts', 'create-posts', 'update-posts', 'delete-posts'];
        $registeredPermissions = Permission::whereIn('slug', $registeredPermissions)->get();
        $registeredRole = Role::where('slug', 'registered')->first();

        $tags = Tag::factory()->count(10)->create();

        $admin = User::factory()
            ->has(Post::factory()
                ->count(2)
            )->create([
                'name' => 'Pavel',
                'email' => 'admin@mail.ru',
                'password' => Hash::make('1')
            ]);

        $admin->posts()->each(function ($post)  use ($tags) {
           $post->tags()->attach($tags->random(random_int(0, 2)));
        });

        $admin->roles()->attach($adminRole);
        $admin->permissions()->attach($adminPermissions);

        User::factory()
            ->has(Post::factory()
                ->count(9))
            ->count(2)
            ->create()
            ->each(function (User $user) use ($registeredRole, $registeredPermissions, $tags) {
                $user->roles()->attach($registeredRole);
                $user->permissions()->attach($registeredPermissions);
                $user->posts()->each(function ($post) use ($tags) {
                    $post->tags()->attach($tags->random(random_int(1, 2)));
                });
            })
        ;

        $adminRole->permissions()->attach(Permission::all());
        $registeredRole->permissions()->attach(Permission::all());
    }
}
