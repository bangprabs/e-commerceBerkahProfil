<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratingRecords = [
            [
                'id'=>1,
                'user_id'=> 17,
                'product_id' => 11,
                'review' => 'Kiriman sudah sampai, tidak ada yang pecah. Barang nya Oke !',
                'rating' => 5,
                'status' => 1
            ],
            [
                'id'=>2,
                'user_id'=> 17,
                'product_id' => 12,
                'review' => 'Kiriman sudah sampai dengan selamat, tidak ada yang pecah. Barang nya Oke !',
                'rating' => 4,
                'status' => 1
            ]
        ];
        Rating::insert($ratingRecords);
    }
}
