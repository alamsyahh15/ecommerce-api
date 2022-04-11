<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProvinceController;
use App\Http\Controllers\Api\RegencyController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VillageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('user')->group(function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'store']);
    Route::middleware('auth:users')->group(function () {
        Route::get('/my-profile', [UserController::class, 'show']);
        Route::get('/my-addresses', [AddressController::class, 'index']);
        Route::post('update', [UserController::class, 'update']);
        Route::post('logout', [UserController::class, 'destroySession']);
    });
});


Route::prefix('address')->group(function () {
    Route::get('/provinces', [ProvinceController::class, 'index']);
    Route::get('/regencies/{id?}', [RegencyController::class, 'index']);
    Route::get('/districts/{id?}', [DistrictController::class, 'index']);
    Route::get('/villages/{id?}', [VillageController::class, 'index']);
    Route::post('/update', [AddressController::class, 'update']);
    Route::post('/delete', [AddressController::class, 'destroy']);
});



Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
});
