<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RolesGmosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_gmos')->insert([
            [
                'id' => 1,
                'rol_name' => 'admin',
                'sw_visible' => 'S',
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 2,
                'rol_name' => 'sales',
                'sw_visible' => 'S',
                'created_at' => null,
                'updated_at' => null
            ]
        ]);
    }
}
