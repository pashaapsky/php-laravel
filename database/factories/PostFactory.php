<?php

namespace Database\Factories;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $activeUsers = User::all();

        if ($activeUsers->isEmpty()) {
            $activeUsers = collect([User::factory()->create()]);
        }

        return [
            'code' => $this->faker->unique()->regexify('[a-zA-Z0-9_-]+'),
            'owner_id' => $activeUsers->random(1)->first(),
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->words(3, true),
            'text' => $this->faker->text,
            'published' => boolval(rand(0,1))
        ];
    }
}
