<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Seeder;

class CmsPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cmsPagesRecords =
        [
            [
                'id' => 1,
                'title' => 'About Us',
                'description' => 'Content is coming soon',
                'url' => 'about-us',
                'meta_title' => 'About Us',
                'meta_description' => 'About e-commerce webiste',
                'meta_keywords' => 'about us, about ecommerce',
                'status' => 1
            ],
            [
                'id' => 2,
                'title' => 'Privacy policy',
                'description' => 'Content is coming soon',
                'url' => 'about-us',
                'meta_title' => 'Privacy policy',
                'meta_description' => 'Privacy policy e-commerce webiste',
                'meta_keywords' => 'privacy policy, about ecommerce',
                'status' => 1
            ]
        ];
        CmsPage::insert($cmsPagesRecords);
    }
}
