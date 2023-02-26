<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
        	'name'=>'Đồ Gia Dụng',
        	'slug'=>'do-gia-dung',
        	'user_id'=>'1'
        ]);

        DB::table('categories')->insert([
        	'name'=>'Rau Củ Quả',
        	'slug'=>'rau-cu-qua',
        	'user_id'=>'1'
        ]);

        DB::table('categories')->insert([
        	'name'=>'Thức Uống',
        	'slug'=>'thuc-uong',
        	'user_id'=>'1'
        ]);

        DB::table('categories')->insert([
        	'name'=>'Hạt',
        	'slug'=>'hat',
        	'user_id'=>'1'
        ]);

        DB::table('categories')->insert([
        	'name'=>'Pet Food',
        	'slug'=>'pet-food',
        	'user_id'=>'1'
        ]);

        DB::table('categories')->insert([
        	'name'=>'Đồ Hộp & Đồ Ăn Nhanh',
        	'slug'=>'do-hop-&-do-an-nhanh',
        	'user_id'=>'1'
        ]);

        DB::table('categories')->insert([
        	'name'=>'Đồ Hộp',
        	'slug'=>'do-hop',
        	'parent_id'=>'5',
        	'user_id'=>'1'
        ]);

        DB::table('categories')->insert([
        	'name'=>'Đồ Ăn Nhanh',
        	'slug'=>'do-an-nhanh',
        	'parent_id'=>'5',
        	'user_id'=>'1'
        ]);

        DB::table('categories')->insert([
        	'name'=>'Rau Sạch',
        	'slug'=>'rau-sach',
        	'parent_id'=>'2',
        	'user_id'=>'1'
        ]);

        DB::table('categories')->insert([
        	'name'=>'Gạo',
        	'slug'=>'gao',
        	'parent_id'=>'4',
        	'user_id'=>'1'
        ]);

        DB::table('categories')->insert([
        	'name'=>'Hạt giống',
        	'slug'=>'hat-giong',
        	'parent_id'=>'4',
        	'user_id'=>'1'
        ]);

        DB::table('categories')->insert([
        	'name'=>'Trái Cây',
        	'slug'=>'trai-cay',
        	'parent_id'=>'2',
        	'user_id'=>'1'
        ]);

        DB::table('categories')->insert([
        	'name'=>'Đồ Uống Có Ga',
        	'slug'=>'do-uong-co-ga',
        	'parent_id'=>'3',
        	'user_id'=>'1'
        ]);

        DB::table('categories')->insert([
        	'name'=>'Nước Trái Cây',
        	'slug'=>'nuoc-trai-cay',
        	'parent_id'=>'3',
        	'user_id'=>'1'
        ]);


    }
}
