<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couponRecord = [
            [
                'id'=>1,
                'coupon_option'=>'Manual',
                'coupon_code'=>'xyz123x',
                'categories'=>'1',
                'users'=>'kangojegz@gmail.com',
                'coupon_type'=>'Single',
                'amount_type'=>'Precentage',
                'amount'=>'10',
                'expiry_date'=>'2020-12-31',
                'status'=>1
            ]
        ];
        Coupon::insert($couponRecord);
    }
}
