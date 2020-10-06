<?php

namespace Database\Seeders;

use App\News;
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
        $registeredPermissions = ['view-posts', 'create-posts', 'update-posts', 'delete-posts'];
        $registeredPermissions = Permission::whereIn('slug', $registeredPermissions)->get();

        $registeredRole = Role::where('slug', 'registered')->first();
        $registeredRole->permissions()->attach(Permission::all());

        $tags = Tag::factory()->count(10)->create();

        $admin = User::where('email', env('ADMIN_EMAIL_FOR_NOTIFICATIONS'))->first();

        $admin->posts()->saveMany(Post::factory()->count(2)->create());

        $admin->posts()->each(function ($post)  use ($tags) {
           $post->tags()->attach($tags->random(random_int(0, 2)));
        });

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

        $news = News::all();

        foreach ($news as $new) {
            $new->tags()->attach($tags->random(random_int(0,1)));
        }
    }
}
