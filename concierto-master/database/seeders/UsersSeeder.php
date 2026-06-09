<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Manager',
                'email' => 'ceo@ingesoftllc.com',
                'email_verified_at' => null,
                'password' => '7c222fb2927d828af22f592134e8932480637c0d',
                'remember_token' => null,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 2,
                'name' => 'senior',
                'email' => 'seniordeveloper@ingesoftllc.com',
                'email_verified_at' => null,
                'password' => '7c222fb2927d828af22f592134e8932480637c0d',
                'remember_token' => null,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 3,
                'name' => 'dealer',
                'email' => 'backend-developer@ingesoftllc.com',
                'email_verified_at' => null,
                'password' => '7c222fb2927d828af22f592134e8932480637c0d',
                'remember_token' => null,
                'created_at' => null,
                'updated_at' => null
            ]
        ]);
    }
}
