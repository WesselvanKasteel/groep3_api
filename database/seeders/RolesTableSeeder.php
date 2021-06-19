<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

use App\Models\Role;

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
                'role' => $role,
            ]);
        }
    }
}
