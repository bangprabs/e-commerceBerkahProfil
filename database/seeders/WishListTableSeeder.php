<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wishlistRecords = [
            [
               'id' => 1,
               'user_id' => 17,
               'product_id' => 11
            ],
            [
                'id' => 2,
                'user_id' => 17,
                'product_id' => 13
             ],
        ];
        Wishlist::insert($wishlistRecords);
    }
}
