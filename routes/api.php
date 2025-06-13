<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JwtAuthController;
use App\Http\Controllers\Api\ApiMenuController; 
use App\Http\Controllers\Api\BasicAuthMenuController;

Route::middleware('auth.basic')->group(function () {
    Route::get('menus-basic', [BasicAuthMenuController::class, 'index']);
    Route::post('menus-basic', [BasicAuthMenuController::class, 'store']);
    Route::put('menus-basic/{id}', [BasicAuthMenuController::class, 'update']);
    Route::delete('menus-basic/{id}', [BasicAuthMenuController::class, 'destroy']);
});

Route::middleware('auth.basic')->group(function () {
    Route::get('/basic-protected', function () {
        return response()->json(['message' => 'Anda berhasil login dengan Basic Auth']);
    });
});

 Route::post('register', [JwtAuthController::class, 'register']);
 Route::post('login', [JwtAuthController::class, 'login']);

 Route::middleware(['jwt.verify'])->group(function () {
     Route::get('menus', [ApiMenuController::class, 'index']);       // GET semua menu
     Route::post('menus', [ApiMenuController::class, 'store']);       // POST tambah menu
     Route::put('menus/{id}', [ApiMenuController::class, 'update']); // PUT edit menu
     Route::delete('menus/{id}', [ApiMenuController::class, 'destroy']); // DELETE menu
     Route::get('me', [JwtAuthController::class, 'me']); // GET Data Diri
     Route::post('logout', [JwtAuthController::class, 'logout']); // POST Keluar
 }); 



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
