<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            'date_of_birth' => Carbon::create(1999, 7, 3, 0),
            'picture' => 'iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAJlSURBVHgB7dlBbtNAFAbg/43rEIGEzA6JNjKIfcMJCKJBsCI9AXACeoNmxzLqii2cgHSHKBLJjmU4AGBQFl0g4VKQIPbMY9wiJCQUJ57ntov5Vok0Sfx7PJ7nF8DzPM/zqiPUpLm60WHCfQZFxz/EqWbs5tPXI9RAPEhj7XYPFAzAHP93AFHCQD/7/Oo5BAUQ1Gjd6dsjfWpfRnOGRfbs9ejidTLf3o8gRCzIUQjm7UXHE6EjGUbk0mrGd2Oj9UdUYJhvSawbBQGs8wEqItDCszj/e1zFnaihw69wMDvMLiEdpXDgPCPNfKUNR+GFMIYj5yCGOIIzsw5HImvEFZNK4Mg5iArCCRzlefYJjpyD/ExeJmC4hEmwP0rgSOb2y3oHFbExfQgQq7XOrXXf2Bqqs8xnipmcTfduQIDYYv+VZY9QXCaLS2Z5tgkhckXj9yTV51u7KgiKonDu3mJAw+wwu4cvo30IqeV5pLnavakJD4ltIPobypbvPGSmYT7dG8PzvBMlutjDK91iYbeV4nW7p8R2YUdEFNsdM7XvUyJO7Q8mpnhuN/xOshHhFCSyzyI/TPhAMXrG3p3sXWqpSth2WVJ7L55A0bNAqfFRuVNRpSDHrR7aXnonL8VDw9ipMlNLBQnjbltpDOQD/MvO1CRQweYyM7Twzh62NrbI0Av7MkbN7Nm9zMxby3RZFgpStHrs9f8EJ6xoGano2oE5+PC2dGzZAJdWjxRbv10tu8xKq1+tzWOcMq3z0mMoDWKbzwLNBTf0pxE+z5loPkjwQc6albIBbPSYVG3/By2EDUbwPM/zvBr9Bp803LP1WHVcAAAAAElFTkSuQmCC',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

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
            'picture' => 'iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAJlSURBVHgB7dlBbtNAFAbg/43rEIGEzA6JNjKIfcMJCKJBsCI9AXACeoNmxzLqii2cgHSHKBLJjmU4AGBQFl0g4VKQIPbMY9wiJCQUJ57ntov5Vok0Sfx7PJ7nF8DzPM/zqiPUpLm60WHCfQZFxz/EqWbs5tPXI9RAPEhj7XYPFAzAHP93AFHCQD/7/Oo5BAUQ1Gjd6dsjfWpfRnOGRfbs9ejidTLf3o8gRCzIUQjm7UXHE6EjGUbk0mrGd2Oj9UdUYJhvSawbBQGs8wEqItDCszj/e1zFnaihw69wMDvMLiEdpXDgPCPNfKUNR+GFMIYj5yCGOIIzsw5HImvEFZNK4Mg5iArCCRzlefYJjpyD/ExeJmC4hEmwP0rgSOb2y3oHFbExfQgQq7XOrXXf2Bqqs8xnipmcTfduQIDYYv+VZY9QXCaLS2Z5tgkhckXj9yTV51u7KgiKonDu3mJAw+wwu4cvo30IqeV5pLnavakJD4ltIPobypbvPGSmYT7dG8PzvBMlutjDK91iYbeV4nW7p8R2YUdEFNsdM7XvUyJO7Q8mpnhuN/xOshHhFCSyzyI/TPhAMXrG3p3sXWqpSth2WVJ7L55A0bNAqfFRuVNRpSDHrR7aXnonL8VDw9ipMlNLBQnjbltpDOQD/MvO1CRQweYyM7Twzh62NrbI0Av7MkbN7Nm9zMxby3RZFgpStHrs9f8EJ6xoGano2oE5+PC2dGzZAJdWjxRbv10tu8xKq1+tzWOcMq3z0mMoDWKbzwLNBTf0pxE+z5loPkjwQc6albIBbPSYVG3/By2EDUbwPM/zvBr9Bp803LP1WHVcAAAAAElFTkSuQmCC',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
