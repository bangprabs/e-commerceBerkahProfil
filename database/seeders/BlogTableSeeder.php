<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogRecords = [
            [
                'id' => 1,
                'catblog_id' => 1,
                'blog_title' => '10 Principles of Psychology You Can Use to Improve Your Smart Product',
                'blog_author' => 'Agung Prabowo',
                'blog_date' => '2020-12-31',
                'blog_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore eto dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcol laboris nisi ut aliquipp ex ea commodo consequat. Duis aute irure dolor in reprehenderit inloifk voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaec cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'front_image' => '',
                'main_image' => '',
                'is_featured' => 'No',
                'status' => 1
            ]
        ];
        Blog::insert($blogRecords);
    }
}
