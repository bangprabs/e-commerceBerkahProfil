<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderStatusRecord = [
            [
                'id' => 1,
                'name' => 'Baru',
                'status' => 1
            ],
            [
                'id' => 2,
                'name' => 'Ditunda',
                'status' => 1
            ],
            [
                'id' => 3,
                'name' => 'Ditahan',
                'status' => 1
            ],
            [
                'id' => 4,
                'name' => 'Dibatalkan',
                'status' => 1
            ],
            [
                'id' => 5,
                'name' => 'Dalam Proses',
                'status' => 1
            ],
            [
                'id' => 6,
                'name' => 'Terbayar',
                'status' => 1
            ],
            [
                'id' => 7,
                'name' => 'Dikirim',
                'status' => 1
            ],
            [
                'id' => 8,
                'name' => 'Sampai Tujuan',
                'status' => 1
            ]
        ];
        OrderStatus::insert($orderStatusRecord);
    }
}
