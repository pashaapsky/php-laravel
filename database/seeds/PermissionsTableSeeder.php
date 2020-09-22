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
            ->count(5)
            ->state(new Sequence(
                ['name' => 'viewAny'],
                ['name' => 'view'],
                ['name' => 'create'],
                ['name' => 'update'],
                ['name' => 'delete'],
            ))
            ->create();
    }
}
