<?php

namespace Database\Seeders;

use App\Models\DeliveryAddress;
use Illuminate\Database\Seeder;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryRecords = [
            [
                'id' => 2,
                'user_id' => 17,
                'name' => 'Agung Prabowo',
                'address' => 'Kampung Bedahan, RT 08 RW 02, No, 37',
                'city' => 'Jogjakarta',
                'state' => 'Jawa Tengah',
                'country' => 'Indonesia',
                'pincode' => '55151',
                'mobile' => '082110984618',
                'status' => 1
            ]
        ];
        DeliveryAddress::insert($deliveryRecords);
    }
}
