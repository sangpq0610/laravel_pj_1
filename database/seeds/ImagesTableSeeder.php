<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->truncate();
        for($i=1;$i<=20;$i++){
        DB::table('images')->insert([
        	'path'=>'/storage/images/'.$i.'.png',
        	'type'=>'png',
        	'size'=>100+$i,
            'product_id'=>$i
        ]);
    	}
        DB::table('images')->insert([
            'path'=>'/storage/images/16.jpg',
            'type'=>'jpg',
            'size'=>100,
            'category_id'=>1
        ]);
        DB::table('images')->insert([
            'path'=>'/storage/images/27.jpg',
            'type'=>'jpg',
            'size'=>100,
            'category_id'=>5
        ]);
        DB::table('images')->insert([
            'path'=>'/storage/images/25.jpg',
            'type'=>'jpg',
            'size'=>100,
            'category_id'=>14
        ]);
        DB::table('images')->insert([
            'path'=>'/storage/images/25.jpg',
            'type'=>'jpg',
            'size'=>100,
            'category_id'=>3
        ]);
        DB::table('images')->insert([
            'path'=>'/storage/images/17.jpg',
            'type'=>'jpg',
            'size'=>100,
            'category_id'=>2
        ]);
        DB::table('images')->insert([
            'path'=>'/storage/images/12.jpg',
            'type'=>'jpg',
            'size'=>100,
            'category_id'=>4
        ]);
        DB::table('images')->insert([
            'path'=>'/storage/images/3.jpg',
            'type'=>'jpg',
            'size'=>100,
            'category_id'=>13
        ]);
        DB::table('images')->insert([
            'path'=>'/storage/images/17.jpg',
            'type'=>'jpg',
            'size'=>100,
            'category_id'=>12
        ]);
        DB::table('images')->insert([
            'path'=>'/storage/images/28.jpg',
            'type'=>'jpg',
            'size'=>100,
            'category_id'=>6
        ]);
    }
}
