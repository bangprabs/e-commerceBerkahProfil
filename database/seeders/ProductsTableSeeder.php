<?php

namespace Database\Seeders;

use App\Models\Product;
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
        $productsRecords = [
            [
                'id' => 1,
                'category_id' =>7,
                'product_name' =>'Lis Profil Beton Motif Candi',
                'product_code' =>'CND001',
                'product_color' =>'Blue',
                'product_price' =>'120000',
                'product_color' =>'Natural',
                'product_discount' =>0,
                'product_weight' =>1.5,
                'product_video' =>'',
                'main_image' =>'',
                'description' =>'Test Product',
                'material' =>'concrete',
                'meta_title' =>'',
                'meta_description' =>'',
                'meta_keywords' =>'',
                'is_featured'=>'No',
                'status' =>1
            ],
            [
                'id' => 2,
                'category_id' =>1,
                'product_name' =>'Pot Batu Alam',
                'product_code' =>'PBA001',
                'product_color' =>'Natural Stone',
                'product_price' =>'75000',
                'product_discount' =>0,
                'product_weight' =>2.2,
                'product_video' =>'',
                'main_image' =>'',
                'description' =>'Test Product',
                'material' =>'stone',
                'meta_title' =>'',
                'meta_description' =>'',
                'meta_keywords' =>'',
                'is_featured'=>'Yes',
                'status' =>1
            ]
        ];
        Product::insert($productsRecords);
    }
}
