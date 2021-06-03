<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['employer', 'unemployed'];

        foreach($roles as $role)
        {
            DB::table('roles')->insert([
                'id' => Uuid::generate(),
                // 'user_id' => User::first()->id,
                'role' => $role,
            ]);
        }
    }
}