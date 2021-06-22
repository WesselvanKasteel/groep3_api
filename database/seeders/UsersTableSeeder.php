<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

use App\Models\Role;
use App\Models\User;

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
            'date_of_birth' => Carbon::create(1999, 7, 3, 0),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::where('phone_number', '=', '06121212')->first();
        $role = Role::where('role', '=', 'unemployed')->first();
        $user->assignRole($role);

        DB::table('users')->insert([
            'id' => Uuid::generate(),
            'first_name' => 'Wessel',
            'prefix' => 'van',
            'last_name' => 'Kasteel',
            'country' => 'Nederland',
            'province' => 'Zuid-Holland',
            'city' => 'Leiden',
            'address' => 'Luisterlaan 14',
            'email' => 'wessel@mail.com',
            'password' => bcrypt('bimpsert'),
            'phone_number' => '0634343434',
            'date_of_birth' => Carbon::create(2001, 7, 31, 0),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::where('phone_number', '=', '0634343434')->first();
        $role = Role::where('role', '=', 'unemployed')->first();
        $user->assignRole($role);

        DB::table('users')->insert([
            'id' => Uuid::generate(),
            'first_name' => 'Matt',
            'last_name' => 'Verdoes',
            'country' => 'Nederland',
            'province' => 'Zuid-Holland',
            'city' => 'Katwijk aan zee',
            'address' => 'Neptunus 49',
            'email' => 'matt@mail.com',
            'password' => bcrypt('bimpsert'),
            'phone_number' => '0687654321',
            'date_of_birth' => Carbon::create(2001, 12, 11, 0),
            'external_cv' => 'https://www.linkedin.com/in/matt-verdoes-230728185/',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::where('phone_number', '=', '0687654321')->first();
        $role = Role::where('role', '=', 'unemployed')->first();
        $user->assignRole($role);

        DB::table('users')->insert([
            'id' => Uuid::generate(),
            'company_name' => 'North Face',
            'country' => 'Nederland',
            'province' => 'Noord-Holland',
            'city' => 'Amsterdam',
            'address' => 'Camera Obscuralaan 107',
            'email' => 'northface@mail.com',
            'password' => bcrypt('bimpsert'),
            'phone_number' => '0612345678',
            'date_of_birth' => Carbon::create(1990, 1, 10, 0),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::where('phone_number', '=', '0687652321')->first();
        $role = Role::where('role', '=', 'employer')->first();
        $user->assignRole($role);

        DB::table('users')->insert([
            'id' => Uuid::generate(),
            'first_name' => 'Felipe',
            'last_name' => 'Noordegraaf',
            'country' => 'Nederland',
            'province' => 'Zuid-Holland',
            'city' => 'Den Haag',
            'address' => 'Groenland 4',
            'email' => 'felep@mail.com',
            'password' => bcrypt('bimpsert'),
            'phone_number' => '0648365532',
            'date_of_birth' => Carbon::create(1999, 6, 8, 0),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::where('phone_number', '=', '0687654621')->first();
        $role = Role::where('role', '=', 'unemployed')->first();
        $user->assignRole($role);

        

    }
}
