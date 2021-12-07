<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            [
                'id'=>1,
                'parent_id'=>0,
                'category_name'=>'Batu Alam',
                'category_image'=>'',
                'category_discount'=>0,
                'description'=>'',
                'url'=>'t-shirt',
                'meta_title'=>'',
                'meta_description'=>'',
                'meta_keywords'=>'',
                'status'=> 1
            ],
            [
                'id'=>2,
                'parent_id'=>1,
                'category_name'=>'Pot Tanaman Batu Alam',
                'category_image'=>'',
                'category_discount'=>0,
                'description'=>'',
                'url'=>'pot-batu-alam',
                'meta_title'=>'',
                'meta_description'=>'',
                'meta_keywords'=>'',
                'status'=> 1
            ],
        ];
        Category::insert($categoryRecords);
    }
}
