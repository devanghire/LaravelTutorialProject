<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {

    Route::post('register', 'signup')->name('register');
    Route::post('login','login')->name('loginuser');
    Route::any('logout','logout')->middleware('auth:sanctum');
});


# Becouse we create API RESOURCE CONTROLLER so we use api resource
# middleware use coz we have check the user session every time to access all apis
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', PostController::class);
});
