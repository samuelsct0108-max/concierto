<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersGmosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_gmos')->insert([
            [
                'id' => 1,
                'name' => 'Manager',
                'user_id' => 1,
                'email' => 'ceo@ingesoftllc.com',
                'password' => '7c222fb2927d828af22f592134e8932480637c0d',
                'id_rol' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 2,
                'name' => 'senior',
                'user_id' => 2,
                'email' => 'seniordeveloper@ingesoftllc.com',
                'password' => '7c222fb2927d828af22f592134e8932480637c0d',
                'id_rol' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 3,
                'name' => 'dealer',
                'user_id' => 3,
                'email' => 'backend-developer@ingesoftllc.com',
                'password' => '7c222fb2927d828af22f592134e8932480637c0d',
                'id_rol' => 2,
                'created_at' => null,
                'updated_at' => null
            ]
        ]);
    }
}
