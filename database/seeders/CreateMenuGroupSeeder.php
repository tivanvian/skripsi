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
                'slug'          => 'config',
                'name'          => 'Config',
                'description'   => 'Config for Admin',
            ],
            [
                'slug'          => 'management-web',
                'name'          => 'Management Web',
                'description'   => 'Website Management',
            ],
        ];

        foreach ($menugroups as $key => $group) {
            MenuGroup::create($group);
        }
    }
}
