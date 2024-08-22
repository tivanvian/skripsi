<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QueueController as Queue;
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

// Route::middleware(['verified-user'])->group(function () {
    // Route::get('/home', [HomeController::class, 'backend'])->name('home.index');
// });

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::middleware(['auth'])->group(function () {
    // Route::get('/home', [HomeController::class, 'backend'])->name('home.index');
    
});


Route::get('/antrian/home', [Queue::class, 'antrianHome'])->name('antrian.home');
Route::get('/antrian/display', [Queue::class, 'antrianDisplay'])->name('antrian.display');
Route::get('/antrian/queue/{id}', [Queue::class, 'antrianQueue'])->name('antrian.queue');
Route::get('/antrian/get-call/{wilayah}', [Queue::class, 'antrianGetCall'])->name('antrian.get-call');
Route::get('/antrian/get-now/{wilayah}', [Queue::class, 'antrianGetNow'])->name('antrian.get-now');
Route::get('/antrian/post-call/{wilayah}/{caller}/{loket?}/{number?}', [Queue::class, 'antrianPostCall'])->name('antrian.post-call');
Route::post('/antrian/get-antrian', [Queue::class, 'getAntrian'])->name('antrian.get-antrian');
Route::post('/antrian/login/post', [Queue::class, 'antrianLoginPost'])->name('antrian.login.post');

Route::get('change/lang', [HomeController::class, 'changeLang'])->name('change.lang');
Route::get('captcha/reload', [HomeController::class, 'reloadCaptcha'])->name('captcha.reload');

Route::get('test-event',
    function () {
        event(new \App\Events\testingEvent('test message'));
        return 'Event has been sent!';
    }
);
