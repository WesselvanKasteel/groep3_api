<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = ['HTML', 'CSS', 'JS', 'React', 'Vue'];

        foreach($skills as $skill)
        {
            DB::table('skills')->insert([
                'id' => Uuid::generate(),
                'skill' => $skill,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
