<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannersRecord = [
            [
                'id' => 1,
                'image' => 'banner1.png',
                'link' => '',
                'title' => 'Selamat Datang di Berkah Profil',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'alt' => 'Berkah Profil',
                'status' => 1
            ],
            [
                'id' => 2,
                'image' => 'banner2.png',
                'link' => '',
                'title' => 'E Coommerce Batu Alam ',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'alt' => 'E Commerce Batu Alam',
                'status' => 1
            ],
            [
                'id' => 3,
                'image' => 'banner3.png',
                'link' => '',
                'title' => 'E Commerce Roster',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'alt' => 'E Commerce Roster',
                'status' => 1
            ]
        ];
        Banner::insert($bannersRecord);
    }
}
