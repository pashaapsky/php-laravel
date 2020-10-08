<?php

namespace Database\Factories;

use App\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'text' => $this->faker->text(250),
        ];
    }
}
