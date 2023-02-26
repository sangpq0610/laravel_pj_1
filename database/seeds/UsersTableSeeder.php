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
    	DB::table('users')->truncate();

    	DB::table('users')->insert([
        	'name'=>'admin'.1,
        	'email'=>'vipcristedo'.1.'@gmail.com',
        	'password'=>bcrypt('123456'),
        	'role'=>2,
        	'phone'=>'0984701585',
        	'address'=>'AL-HP'
        ]);
    }
}
