<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();

    	for ($i=1;$i<=20;$i++){
    	DB::table('products')->insert([
        	'name'=>'sp'.$i,
        	'slug'=>'sp-'.$i,
        	'content'=>'test '.$i,
        	'origin_price'=>'10000',
        	'sale_price'=>'9000',
        	'user_id'=>'1',
        	'category_id'=>'1',
            'nomination'=>'1',
        	'amount'=>'100'
        ]);
    	}
    }
}
