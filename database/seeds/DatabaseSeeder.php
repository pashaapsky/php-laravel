<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Pavel',
                'email' => 'admin@mail.ru',
                'password' => bcrypt('1'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'user',
                'email' => 'user@mail.ru',
                'password' => Hash::make('1'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        $grants = [
            ['id' => 1, 'name' => 'admin'],
            ['id' => 2, 'name' => 'registered'],
        ];

        $grant_user = [
            ['grant_id' => 1, 'user_id' => 1],
            ['grant_id' => 2, 'user_id' => 2],
        ];

        DB::table('users')->insert($users);
        DB::table('grants')->insert($grants);
        DB::table('grant_user')->insert($grant_user);
    }
}
