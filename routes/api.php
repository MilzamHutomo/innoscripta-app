<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
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

Route::controller(AuthController::class)->group(function(){
    Route::post('/login','login');
    Route::post('/register','register');
});

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('users','index');
        Route::post('/users','store');
        Route::delete('/users','delete');
        Route::put('/users/{id}','update');
        Route::get('/users/{id}','find');
    });

});


