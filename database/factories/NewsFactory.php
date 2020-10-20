<?php

namespace Database\Factories;

use App\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'text' => $this->faker->realText($maxNbChars = 1000, $indexSize = 2),
        ];
    }
}
