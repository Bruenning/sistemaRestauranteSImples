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
        //possíveis horarios da reserva 18:00 as 23:59 intervalo de 30 minutos para gerar aleatorio na seed
        $possibleTimes = ['18:00:00', '18:30:00', '19:00:00', '19:30:00', '20:00:00', '20:30:00', '21:00:00', '21:30:00','22:00:00', '22:30:00', '23:00:00', '23:30:00'];

        $time = $possibleTimes[array_rand($possibleTimes)];

        return [
            'dateReservation' => $this->faker->dateTimeBetween('now', '+1 years'),
            'timeReservation' => $time,
            'user_id' => $this->faker->numberBetween(1, 10),       
        ];
    }
}