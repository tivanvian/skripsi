<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Role;
use App\Models\RoleMenu;
use App\Models\Menu;
use Auth;

class UserPermessions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(session('default_role') == null || session('default_role') == ''){
            if(\Auth::check()){
                if (Auth::user()->getTypeRole() == 'admin') {
                    session(['default_role' => Auth::user()->getDefaultRole()]);
                    return redirect()->route(defaultRoute());
                } else {
                    return redirect()->route('index');
                }
            } else {
                \Auth::logout();
                return redirect()->route('login');
            }
        }


        $RouteNotIn = [
            'admin.user.change_session_role',
            'admin.artisan.cache',
            'admin.artisan.optimize',
            'admin.artisan.optimizeclear',
            'admin.artisan.storage',
        ];

        if(in_array(Route::currentRouteName(), $RouteNotIn)){
            return $next($request);
        }

        $menu = Menu::whereIsActive('t')->whereRoute(Route::currentRouteName())->first();
        $role = RoleMenu::where('role_slug', session('default_role'))->where('menu_group', $menu->group)->first();

        if(!empty($role)){
            if(!empty($menu) && $menu->group == $role->menu_group){
                // dd([$menu->permessions, $role->access]);
                if(in_array($menu->permessions, $role->access)){
                    return $next($request);
                } else {
                    session()->flash('error', 'You do not have permission to access for this page..');
                }
            } else {
                session()->flash('error', 'You route is not register in Menu.');
            }
        } else {
            session()->flash('error', 'You do not have permission to access for this page...');
        }

        return redirect()->route('index');

    }
}
