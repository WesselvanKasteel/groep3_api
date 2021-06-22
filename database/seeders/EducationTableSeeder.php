<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class EducationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educations = ['HAVO', 'HBO'];

        foreach($educations as $education)
        {
            DB::table('education')->insert([
                'id' => Uuid::generate(),
                'education' => $education,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
