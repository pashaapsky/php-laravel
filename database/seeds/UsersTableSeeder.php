<?php

namespace Database\Seeders;

use App\Post;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::factory()->has(Post::factory()->count(2))->create([
            'name' => 'Pavel',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('1')
        ]);

        User::factory()->has(Post::factory()->count(2))->count(3)->create();
    }
}
