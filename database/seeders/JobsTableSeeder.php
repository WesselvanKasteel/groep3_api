<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = ['Vakkenvuller', 'Postbode', 'Administratief medewerker'];

        foreach($jobs as $job)
        {
            DB::table('jobs')->insert([
                'id' => Uuid::generate(),
                'job' => $job,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
