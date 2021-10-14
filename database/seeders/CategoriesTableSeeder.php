<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            [
                'category_name' =>  'Meat',
                'parent_id' => 0,
                'left' => 0,
                'right' => 0,
                'level' => 0,
                'cate_ordering' => 1
            ],
            [
                'category_name' =>  'Cereal',
                'parent_id' => 0,
                'left' => 0,
                'right' => 0,
                'level' => 0,
                'cate_ordering' => 2
            ],
            [
                'category_name' =>  'Frozen',
                'parent_id' => 0,
                'left' => 0,
                'right' => 0,
                'level' => 0,
                'cate_ordering' => 4
            ],
            [
                'category_name' =>  'Cheese',
                'parent_id' => 0,
                'left' => 0,
                'right' => 0,
                'level' => 0,
                'cate_ordering' => 5
            ],
        ]);
    }
}
