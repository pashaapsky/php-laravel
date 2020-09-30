<?php

namespace Database\Seeders;

use App\Permission;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'name' => 'view posts',
                'slug' => 'view-posts'
            ],
            [
                'name' => 'create posts',
                'slug' => 'create-posts'
            ],
            [
                'name' => 'update posts',
                'slug' => 'update-posts'
            ],
            [
                'name' => 'delete posts',
                'slug' => 'delete-posts'
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::factory()->create([
                'name' => $permission['name'],
                'slug' => $permission['slug']
            ]);
        }
    }
}
