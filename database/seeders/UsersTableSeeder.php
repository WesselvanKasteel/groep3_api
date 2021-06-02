<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => Uuid::generate(),
            'first_name' => 'Tim',
            'last_name' => 'Esveldt',
            'country' => 'Nederland',
            'province' => 'Zuid-Holland',
            'city' => 'Leiden',
            'address' => 'Luisterlaan 13',
            'email' => 'tim@mail.com',
            'password' => bcrypt('bimpsert'),
            'phone_number' => '06121212',
            'date_of_birth' => now(),
        ]);
    }
}
