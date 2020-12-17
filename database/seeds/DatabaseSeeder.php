<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
    		'nombre'  => 'Admin',
    		'login'  => 'admin',
    		'password'  => Hash::make('123456'),
    		'estado'     => 'A',
    	]);
    }
}
