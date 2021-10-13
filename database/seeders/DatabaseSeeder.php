<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Str;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //users
        DB::table('users')->insert([
            'id' => 1,
            'name' => "first customername",
            'email' => "customer111@gmail.com",
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => "second customername",
            'email' => "customer222@gmail.com",
            'password' => Hash::make('password'),
        ]);


        DB::table('users')->insert([
            'id' => 3,
            'name' => "adminname",
            'email' => "admin@gmail.com",
            'password' => Hash::make('password'),
        ]);

        //roles        
        DB::table('roles')->insert([
            'id' => 1,
            'name' => "customer",
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => "admin",
        ]);

        //users_roles        
        DB::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        DB::table('user_roles')->insert([
            'user_id' => 2,
            'role_id' => 1,
        ]);

        DB::table('user_roles')->insert([
            'user_id' => 3,
            'role_id' => 2,
        ]);

        //issues
        DB::table('issues')->insert([
            'title' => 'first problem',
            'description' => 'this is the description of the first problem',
            'user_id' => 1,
        ]);

        DB::table('issues')->insert([
            'title' => 'second problem',
            'description' => 'this is the description of the second problem',
            'user_id' => 1,
        ]);

        DB::table('issues')->insert([
            'title' => 'third problem',
            'description' => 'this is the description of the third problem',
            'user_id' => 2,
        ]);
    }
}
