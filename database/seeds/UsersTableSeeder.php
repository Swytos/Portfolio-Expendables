<?php

use Illuminate\Database\Seeder;

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
            'name' => 'Anton',
            'email' => 'anton.zaika@anstrex.com',
            'role' => 'Admin',
            'password' => bcrypt('password'),
        ]);
    }
}
