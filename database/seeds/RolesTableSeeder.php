<?php

namespace Database\Seeders;

use App\Role;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()
            ->count(3)
            ->state(new Sequence(
                ['name' => 'admin'],
                ['name' => 'moderator'],
                ['name' => 'registered']
            ))
            ->create();
    }
}
