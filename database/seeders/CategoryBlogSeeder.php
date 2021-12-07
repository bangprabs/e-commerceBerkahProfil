<?php

namespace Database\Seeders;

use App\Models\CategoryBlog;
use Illuminate\Database\Seeder;

class CategoryBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionsRecords = [
            [
                'id' => 1,
                'name' => 'Lis Profil Beton',
                'status'=> 1
            ],
            [
                'id' => 2,
                'name' => 'Ornamen Batu Alam',
                'status'=> 1
            ],
            [
                'id' => 3,
                'name' => 'Roster Beton',
                'status'=> 1
            ]
        ];
        CategoryBlog::insert($sectionsRecords);
    }
}
