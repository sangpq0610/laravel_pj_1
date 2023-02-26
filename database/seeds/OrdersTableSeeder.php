<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('orders')->truncate();
    	for($i=1;$i<=5;$i++){
    	DB::table('orders')->insert([
    		'money'=>$i.'00000',
    		'user_id'=>$i,
            'status'=>0,
            'created_at'=>'2020-02-11 17:35:45'
        ]);
    	}
    }
}
