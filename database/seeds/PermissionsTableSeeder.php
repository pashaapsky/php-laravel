<?php

namespace Database\Seeders;

use App\Permission;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::factory()
            ->count(3)
            ->state(new Sequence(
                ['name' => 'user.create'],
                ['name' => 'user.update'],
                ['name' => 'user.delete'],
            ))
            ->create();
    }
}
