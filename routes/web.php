<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// GANTI INI: Route awal homepage pakai controller agar variabel $menus tersedia
Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('/api-doc', function () {
    return view('docs.api-doc');
});

Route::view('/api-doc', 'docs.api-doc');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/search', [MenuController::class, 'search'])->name('menu.search');
Route::get('/order/{id}', [OrderController::class, 'create'])->name('order.create');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/orders', [OrderController::class, 'history'])->name('order.history')->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [OrderController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/menus', [MenuController::class, 'adminIndex'])->name('admin.menus.index');
    Route::get('/menus/create', [MenuController::class, 'create'])->name('admin.menus.create');
    Route::post('/menus', [MenuController::class, 'store'])->name('admin.menus.store');
    Route::get('/menus/{id}/edit', [MenuController::class, 'edit'])->name('admin.menus.edit');
    Route::put('/menus/{id}', [MenuController::class, 'update'])->name('admin.menus.update');
    Route::delete('/menus/{id}', [MenuController::class, 'destroy'])->name('admin.menus.destroy');
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
    Route::put('/orders/{id}/confirm', [OrderController::class, 'confirm'])->name('admin.orders.confirm');
    Route::put('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('admin.orders.cancel');
});

// Review
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/test-write', function () {
    try {
        $path = public_path('photos/test.txt');
        file_put_contents($path, 'Test tulis file');
        return 'Berhasil menulis ke: ' . $path;
    } catch (\Exception $e) {
        return 'Gagal: ' . $e->getMessage();
    }
});