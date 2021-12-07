<?php

namespace Database\Seeders;

use App\Models\Sections;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
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
                'name' => 'Batu Alam',
                'status'=> 1
            ],
            [
                'id' => 3,
                'name' => 'Roster',
                'status'=> 1
            ]
        ];
        Sections::insert($sectionsRecords);
    }
}
