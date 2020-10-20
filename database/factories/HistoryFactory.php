<?php

namespace Database\Factories;

use App\History;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = History::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomUserEmail = User::all()->random()->email;

        return [
            'post_id' => 1,
            'text' => $this->faker->sentence(),
            'user_email' => $randomUserEmail,
        ];
    }
}
