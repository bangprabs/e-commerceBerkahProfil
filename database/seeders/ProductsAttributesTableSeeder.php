<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductsAttributes;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributesRecords = [
            [
                'id' => 1,
                'product_id' => 1,
                'size' => '10 Cm',
                'price' => '4500',
                'stock' => 10,
                'sku' =>  'BMC-25',
                'status' => 1
            ],
            [
                'id' => 2,
                'product_id' => 1,
                'size' => '35 Cm',
                'price' => '8000',
                'stock' => 20,
                'sku' =>  'BMC-35',
                'status' => 1
            ],
            [
                'id' => 3,
                'product_id' => 1,
                'size' => '50 Cm',
                'price' => '12000',
                'stock' => 30,
                'sku' =>  'BMC-50',
                'status' => 1
            ]
        ];
        ProductsAttributes::insert($productAttributesRecords);
    }
}
