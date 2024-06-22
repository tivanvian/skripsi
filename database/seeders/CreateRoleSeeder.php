<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\RoleMenu;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'slug'              => 'superadmin',
                'name'              => 'Superadmin',
                'default_route'     => 'admin.aindex',
                'is_active'         => 't',
                'role_slug'         => 'superadmin',
                'list_menu'         => [
                    [
                        'menu_group'    => 'aindex',
                        'access'        => ["create","read","update","delete"]
                    ],
                    [
                        'menu_group'    => 'menu-group',
                        'access'        => ["create","read","update","delete"]
                    ],
                    [
                        'menu_group'    => 'role',
                        'access'        => ["create","read","update","delete"]
                    ],
                    [
                        'menu_group'    => 'menu',
                        'access'        => ["create","read","update","delete"]
                    ],
                    [
                        'menu_group'    => 'user',
                        'access'        => ["create","read","update","delete"]
                    ]
                ],
            ],
            [
                'slug'              => 'admin',
                'name'              => 'Admin',
                'default_route'     => 'admin.aindex',
                'is_active'         => 't',
                'role_slug'         => 'admin',
                'list_menu'         => [
                    [
                        'menu_group'    => 'aindex',
                        'access'        => ["create","read","update","delete"]
                    ],
                    [
                        'menu_group'    => 'role',
                        'access'        => ["create","read","update","delete"]
                    ],
                    [
                        'menu_group'    => 'user',
                        'access'        => ["create","read","update","delete"]
                    ]
                ],
            ],
            [
                'slug'              => 'user',
                'name'              => 'User',
                'default_route'     => 'home',
                'is_active'         => 't',
            ],
        ];

        foreach ($roles as $key => $role) {
            $data = Role::create([
                'slug'              => $role['slug'],
                'name'              => $role['name'],
                'default_route'     => $role['default_route'],
                'is_active'         => $role['is_active'],
                ]
            );

            //Create RoleMenu
            if(isset($role['list_menu'])){
                foreach ($role['list_menu'] as $key => $RoleMenu) {
                    $DataRoleMenu = [
                        'role_id'       => $data->id,
                        'role_slug'     => $role['role_slug'],
                        'menu_group'    => $RoleMenu['menu_group'],
                        'access'        => $RoleMenu['access'],
                    ];

                    RoleMenu::create($DataRoleMenu);
                }
            }
        }
    }
}
