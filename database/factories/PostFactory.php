<?php

namespace Database\Factories;

use App\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->regexify('[a-zA-Z0-9_-]+'),
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->words(3, true),
            'text' => $this->faker->text
        ];
    }
}
