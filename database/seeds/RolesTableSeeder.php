<?php

namespace Database\Seeders;

use App\Role;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'slug' => 'admin'
            ],
            [
                'name' => 'site manager',
                'slug' => 'site-manager'
            ],
            [
                'name' => 'registered',
                'slug' => 'registered'
            ]
        ];

        foreach ($roles as $role) {
            Role::factory()->create([
                'name' => $role['name'],
                'slug' => $role['slug']
            ]);
        }
    }
}
