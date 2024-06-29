<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuGroup;

class CreateMenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menugroups = [
            [
                'slug'          => 'main',
                'name'          => 'Main Menu',
                'description'   => 'Main Menu for Admin',
                'order'         => '1'
            ],
            [
                'slug'          => 'config',
                'name'          => 'Config',
                'description'   => 'Config for Admin',
                'order'         => '2'
            ],
            [
                'slug'          => 'management-web',
                'name'          => 'Management Web',
                'description'   => 'Website Management',
                'order'         => '3'
            ],
        ];

        foreach ($menugroups as $key => $group) {
            MenuGroup::create($group);
        }
    }
}
