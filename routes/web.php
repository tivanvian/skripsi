<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
// use App\Http\Controllers\UserController as User;
// use App\Http\Controllers\RoleController as Role;
// use App\Http\Controllers\MenuController as Menu;
// use App\Http\Controllers\MenuGroupController as MenuGroup;

// use App\Http\Controllers\ParamsController as Params;
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
Auth::routes([
    'verify' => true,
    'register' => false,
    'reset' => false,
]);

Route::middleware(['verified-user'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    // Route::get('/home', [HomeController::class, 'backend'])->name('home.index');
});

Route::get('change/lang', [HomeController::class, 'changeLang'])->name('change.lang');
Route::get('captcha/reload', [HomeController::class, 'reloadCaptcha'])->name('captcha.reload');
