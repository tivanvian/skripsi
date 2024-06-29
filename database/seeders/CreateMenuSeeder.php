<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class CreateMenuSeeder extends Seeder
{
    public function routeResources($icon, $title, $group, $group_slug){
        return [
            [
                'type'              => 'main',
                'icon'              => $icon,
                'title'             => $title,
                'route'             => 'admin.'.$group.'.index',
                'group'             => $group,
                'is_active'         => 't',
                'permessions'       => 'read',
                'menu_group_slug'   => $group_slug
            ],
            [
                'type'              => 'main',
                'icon'              => $icon,
                'title'             => $title.' Create',
                'route'             => 'admin.'.$group.'.create',
                'group'             => $group,
                'is_active'         => 't',
                'permessions'       => 'create',
                'menu_group_slug'   => $group_slug
            ],
            [
                'type'              => 'main',
                'icon'              => $icon,
                'title'             => $title.' Show',
                'route'             => 'admin.'.$group.'.show',
                'group'             => $group,
                'is_active'         => 't',
                'permessions'       => 'read',
                'menu_group_slug'   => $group_slug
            ],
            [
                'type'              => 'main',
                'icon'              => $icon,
                'title'             => $title.' Edit',
                'route'             => 'admin.'.$group.'.edit',
                'group'             => $group,
                'is_active'         => 't',
                'permessions'       => 'update',
                'menu_group_slug'   => $group_slug
            ],
            [
                'type'              => 'main',
                'icon'              => $icon,
                'title'             => $title.' Store',
                'route'             => 'admin.'.$group.'.store',
                'group'             => $group,
                'is_active'         => 't',
                'permessions'       => 'create',
                'menu_group_slug'   => $group_slug
            ],
            [
                'type'              => 'main',
                'icon'              => $icon,
                'title'             => $title.' Update',
                'route'             => 'admin.'.$group.'.update',
                'group'             => $group,
                'is_active'         => 't',
                'permessions'       => 'update',
                'menu_group_slug'   => $group_slug
            ],
            [
                'type'              => 'main',
                'icon'              => $icon,
                'title'             => $title.' Delete',
                'route'             => 'admin.'.$group.'.delete',
                'group'             => $group,
                'is_active'         => 't',
                'permessions'       => 'delete',
                'menu_group_slug'   => $group_slug
            ]
        ];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'type'              => 'main', //Main Or SubMenu
                'icon'              => 'icofont-ui-home',
                'title'             => 'Dashboard',
                'route'             => 'admin.home.index',
                'group'             => 'home.index',
                'is_active'         => 't',
                'permessions'       => 'read',
                'menu_group_slug'   => 'dashboard',
            ],
        ];

        //Create Only Dashboard
        foreach ($menus as $key => $menu) {
            Menu::create($menu);
        }

        //Data Resources
        $DataResources = [
            //Parameter
            [
                'icon'              => 'icofont-settings',
                'title'             => 'Parameters',
                'group'             => 'parameter',
                'menu_group_slug'   => 'config',
            ],
            [
                'icon'              => 'icofont-navigation-menu',
                'title'             => 'Menus',
                'group'             => 'menu',
                'menu_group_slug'   => 'config',
            ],
            [
                'icon'              => 'icofont-navigation-menu',
                'title'             => 'Menu Groups',
                'group'             => 'menu-group',
                'menu_group_slug'   => 'config',
            ],
            [
                'icon'              => 'icofont-ui-user-group',
                'title'             => 'Roles',
                'group'             => 'role',
                'menu_group_slug'   => 'management-web',
            ],
            [
                'icon'              => 'icofont-user-suited',
                'title'             => 'Users',
                'group'             => 'user',
                'menu_group_slug'   => 'management-web',
            ]
        ] ;

        //Create Resources
        foreach ($DataResources as $key => $request) {
            $data = $this->routeResources($request['icon'], $request['title'], $request['group'], $request['menu_group_slug']);

            foreach ($data as $key => $value) {
                Menu::create($value);
            }
        }

        //Add Menu Show List
        Menu::create([
            'type'              => 'main',
            'icon'              => 'icofont-navigation-menu',
            'title'             => 'Menu Show List',
            'route'             => 'admin.menu.show.list',
            'group'             => 'menu',
            'is_active'         => 't',
            'permessions'       => 'read',
            'menu_group_slug'   => 'config'
        ]);
    }
}
