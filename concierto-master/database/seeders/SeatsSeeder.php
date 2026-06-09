<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertar datos en la tabla seats
        DB::table('seats')->insert([
            [
                'price' => 50.00,
                'sold' => true,
                'seat_number' => 101,
                'location' => 'Front Row',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'price' => 30.00,
                'sold' => true,
                'seat_number' => 201,
                'location' => 'Middle Section',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'price' => 20.00,
                'sold' => false,
                'seat_number' => 301,
                'location' => 'Back Section',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

