<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController as User;
use App\Http\Controllers\RoleController as Role;
use App\Http\Controllers\MenuController as Menu;
use App\Http\Controllers\MenuGroupController as MenuGroup;
use App\Http\Controllers\ParameterController as Parameter;
use App\Http\Controllers\WilayahController as Wilayah;
use App\Http\Controllers\QueueController as Queue;
use App\Http\Controllers\QueueConfigController as QueueConfig;
use App\Http\Controllers\SliderController as Slider;
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

    Route::get('home', [HomeController::class, 'adminHome'])->name('home.index');

    Route::post('user/default_role', [User::class, 'ChangeSessionRole'])->name('user.change_session_role');
    Route::get('user/{id}/delete', [User::class, 'delete'])->name('user.delete');
    Route::resource('user', User::class);

    Route::get('role/{id}/delete', [Role::class, 'delete'])->name('role.delete');
    Route::resource('role', Role::class);

    Route::get('menu-group/{id}/delete', [MenuGroup::class, 'delete'])->name('menu-group.delete');
    Route::resource('menu-group', MenuGroup::class);

    Route::get('menu/show/{menu}', [Menu::class, 'showList'])->name('menu.show.list');
    Route::get('menu/{id}/delete', [Menu::class, 'delete'])->name('menu.delete');
    Route::resource('menu', Menu::class);

    Route::get('parameter/{id}/delete', [Parameter::class, 'delete'])->name('parameter.delete');
    Route::resource('parameter', Parameter::class);

    Route::get('wilayah/{id}/delete', [Wilayah::class, 'delete'])->name('wilayah.delete');
    Route::resource('wilayah', Wilayah::class);

    Route::get('queue/{id}/finish', [Queue::class, 'finish'])->name('queue.finish');
    Route::get('queue/{id}/delete', [Queue::class, 'delete'])->name('queue.delete');
    Route::resource('queue', Queue::class);

    Route::get('queue-config/{id}/delete', [QueueConfig::class, 'delete'])->name('queue-config.delete');
    Route::resource('queue-config', QueueConfig::class);

    Route::get('slider/{id}/delete', [Slider::class, 'delete'])->name('slider.delete');
    Route::resource('slider', Slider::class);

    //++FOR NEW ROUTER++//
});
