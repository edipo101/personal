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
    		'nombre'  => 'Wilma',
    		'login'  => 'Wilma',
    		'password'  => Hash::make('4086000'),
    		'estado'     => 'A',
    	]);
    }
}
