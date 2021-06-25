<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class PremiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('premia')->insert([
            'id' => Uuid::generate(),
            'is_authorized' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('premia')->insert([
            'id' => Uuid::generate(),
            'is_authorized' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
