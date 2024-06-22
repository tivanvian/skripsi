<?php

namespace App\Zivar;

use Auth;
use App\Models\Menu as MenuModel;
use App\Models\MenuGroup;
use App\Models\RoleMenu;
use Illuminate\Support\Facades\Route;

class Menu
{
    public static function ActiveMenu($name){
        return (Route::currentRouteName() == $name || request()->route()->getName() == $name) ? 'active' : '';
    }

    public static function ActiveMenuGroup($name){
        return (explode(".",Route::currentRouteName())[1] == $name) ? 'active' : '';
    }

    public static function Render(){
        $class = '';
        $role = RoleMenu::where('role_slug', session('default_role'))->orderBy("menu_group")->get()->pluck('menu_group');
        $menuGroup = MenuGroup::where('is_active', true)->orderBy('order', "ASC")->get();

        $menuDashboard = MenuModel::whereRoute('admin.aindex')->whereIn('group', $role)->first();

        if($menuDashboard){
            $class .= '<li class="sidebar-main-title">';
            $class .= '  <div>';
            $class .= '    <h6 class="lan-1">General</h6>';
            $class .= '  </div>';
            $class .= '</li>';

            $class .= '<li class="sidebar-list">';
            $class .= '  <a class="sidebar-link sidebar-title link-nav '.self::ActiveMenuGroup($menuDashboard->group).'" href="'.route($menuDashboard->route).'">';
            // $class .= '    <svg class="stroke-icon">';
            // $class .= '      <use href="'.asset('themes/assets/svg/icon-sprite.svg#stroke-'.$menuDashboard->icon).'"></use>';
            // $class .= '    </svg>';
            // $class .= '    <svg class="fill-icon">';
            // $class .= '      <use href="'.asset('themes/assets/svg/icon-sprite.svg#fill-'.$menuDashboard->icon).'"></use>';
            // $class .= '    </svg>';
            $class .= '        <span class="'.self::ActiveMenuGroup($menuDashboard->group).'"><i class="icofont '.$menuDashboard->icon.'"></i></span>';
            $class .= '        &nbsp;<span>'.$menuDashboard->title.'</span>';
            $class .= '  </a>';
            $class .= '</li>';
        }

        foreach ($menuGroup as $item) {
            $query = MenuModel::whereRaw("route ilike '%index%'")->whereMenuGroupSlug($item->slug)->where('menu_group_slug', '!=', 'dashboard')->whereIn('group', $role);

            //Get Menu
            $menu = $query->get();

            //Group Menu
            $getGroup = $query->select('menu_group_slug')->groupBy('menu_group_slug')->get()->pluck('menu_group_slug');

            //Render Header Menu Group
            if(in_array($item->slug, $getGroup->toArray())){
                $class .= '<li class="sidebar-main-title">';
                $class .= '    <div>';
                $class .= '        <h6 class="">'.$item->name.'</h6>';
                $class .= '    </div>';
                $class .= '</li>';
            }

            //Render Menu
            foreach ($menu as $item) {
                $class .= '<li class="sidebar-list">';
                $class .= '    <a class="sidebar-link sidebar-title link-nav '.self::ActiveMenuGroup($item->group).'" href="'.route($item->route).'">';
                // $class .= '        <svg class="stroke-icon">';
                // $class .= '            <use href="'.asset('themes/assets/svg/icon-sprite.svg#stroke-'.$item->icon).'"></use>';
                // $class .= '        </svg>';
                // $class .= '        <svg class="fill-icon">';
                // $class .= '            <use href="'.asset('themes/assets/svg/icon-sprite.svg#fill-'.$item->icon).'"></use>';
                // $class .= '        </svg>';
                $class .= '        <span class="'.self::ActiveMenuGroup($item->group).'"><i class="icofont '.$item->icon.'"></i></span>';
                $class .= '        &nbsp;<span>'.$item->title.'</span>';
                $class .= '    </a>';
                $class .= '</li>';
            }
        }

		return $class;
    }
}
