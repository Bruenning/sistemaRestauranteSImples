<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Reservations;


class ReservationsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Reservations::factory()->create([
            'start' => '2021-06-01 00:00:00',
            'end' => '2021-06-01 00:30:00',
            'user_id' => 1,       
        ]);
    }
}