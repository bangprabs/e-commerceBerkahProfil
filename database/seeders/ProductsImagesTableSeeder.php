<?php

namespace Database\Seeders;

use App\Models\ProductsImages;
use Illuminate\Database\Seeder;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsImagesRecords = [
            [
                'id' => 1,
                'product_id' => 1,
                'image' => 'banner_rumah.png-31285.png',
                'status' => 1
            ]
        ];
        ProductsImages::insert($productsImagesRecords);
    }
}
