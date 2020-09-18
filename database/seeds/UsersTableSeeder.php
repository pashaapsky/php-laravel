<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Pavel',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('1')
        ]);

        User::factory()->count(3)->create();
    }
}
