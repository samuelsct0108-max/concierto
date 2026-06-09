<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsSoldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertar datos en la tabla seat_sold
        DB::table('seat_sold')->insert([
            'seat_number' => 1,
            'id_seller' => 1,
            'payment_method' => 'credit_card',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('seat_sold')->insert([
            'seat_number' => 2,
            'id_seller' => 2,
            'payment_method' => 'cash',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
