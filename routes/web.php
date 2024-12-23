<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::view("wel","welcome");//you can also call welcome like this 1st param is routename 2nd is view name 


Route::get('/clear-cache', function () {
    // Run cache clearing commands
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    // Optionally, rebuild caches
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:cache');

    return response()->json(['message' => 'Cache cleared and rebuilt successfully!']);
})->name('clear.cache');



Route::get('/wel', function () {
    return view('welcome');
});



// Route::get('/wel/{id?}', function (string $id=null) {
//     return view('welcome');
// })->whereNumber('id'); //that mean accept only numaric value as param

Route::controller(HomeController::class)->group(function () {

    Route::get('/home', 'home_firstFunction')->name('first');
    Route::any('/hometwo', 'home_secondFunction')->name('hometwo');
    Route::get('/homethree/{name}', 'home_theirdFunction')->name('theird');
});

Route::controller(Dashboard::class)->group(function () {

    Route::get('', 'view')->name('userslist');
    Route::post('add', 'add')->name('adduser');
    Route::get('view/{id}','viewuser')->name('viewuser');
    Route::any('remove/{id}','deleteuser')->name('deleteuser');
});
