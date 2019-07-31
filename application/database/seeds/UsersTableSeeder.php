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
        	[
        		'name' => 'Carlos Vargas',
        		'email' => 'cvargas@frontuari.net',
        		'password' => bcrypt('administrator'),
        		'role' => 'administrator'
        	],
            [
                'name' => 'operator',
                'email' => 'operator@frontuari.net',
                'password' => bcrypt('operator'),
                'role' => 'operator'
            ]
        ]);
    }
}
