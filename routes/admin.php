<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController as User;
use App\Http\Controllers\RoleController as Role;
use App\Http\Controllers\MenuController as Menu;
use App\Http\Controllers\MenuGroupController as MenuGroup;
use App\Http\Controllers\ParameterController as Parameter;
//++FOR NEW CONTROLLER++//

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Auth only login
Route::middleware(['auth', 'user-access', 'user-permessions'])->group(function () {
    Route::get('/optimize', function () {
        return \Artisan::call('optimize');
    })->name('artisan.optimize');

    Route::get('/optimize/clear', function () {
        return \Artisan::call('optimize:clear');
    })->name('artisan.optimizeclear');

    Route::get('/cache', function () {
        return \Artisan::call('cache:clear');
    })->name('artisan.cache');

    //Storage link
    Route::get('/storage', function () {
        return \Artisan::call('storage:link');
    })->name('artisan.storage');

    // Route::view('/home', 'admin.home')->name('aindex');
    Route::get('home', [HomeController::class, 'adminHome'])->name('aindex');
    // Route::get('home/v2', [HomeController::class, 'admin_home_v2'])->name('aindex');

    Route::post('user/default_role', [User::class, 'ChangeSessionRole'])->name('user.change_session_role');
    Route::get('user/{id}/delete', [User::class, 'delete'])->name('user.delete');
    Route::resource('user', User::class);

    Route::get('role/{id}/delete', [Role::class, 'delete'])->name('role.delete');
    Route::resource('role', Role::class);

    Route::get('menu-group/{id}/delete', [MenuGroup::class, 'delete'])->name('menu-group.delete');
    Route::resource('menu-group', MenuGroup::class);

    Route::get('menu/{id}/delete', [Menu::class, 'delete'])->name('menu.delete');
    Route::resource('menu', Menu::class);

    Route::get('parameter/{id}/delete', [Parameter::class, 'delete'])->name('parameter.delete');
    Route::resource('parameter', Parameter::class);

    //++FOR NEW ROUTER++//
});
