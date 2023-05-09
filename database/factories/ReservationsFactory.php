<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReservationsFactory extends Factory
{
    /**
     * 
     * The name of the factory's corresponding model.
     */

    protected $model = \App\Models\Reservations::class;

    /**
     * 
     * Define the model's default state.
     */

    public function definition(): array
    {
        return [
            'start' => $this->faker->dateTimeInInterval('now', '+1 month'),
            'end' => $this->faker->dateTimeInInterval('+1 month', '+30 min'),
            'user_id' => 1,       
        ];
    }
}