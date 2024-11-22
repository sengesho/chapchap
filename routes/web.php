<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\admin;

Route::get('index/', [homeController::class,"first"] )->name('index');
Route::get('home/', [homeController::class,"index"] );
Route::get('redirect/', [homeController::class,"redirect"] );
Route::get('productlist/', [Admin::class,"productlist"] )->name('productlist');

Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomLoginController::class, 'login']);
Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('dashboard');
    });
Route::middleware('auth')->group(function () {
    Route::get('/admin', [admin::class, 'admin'])->name('admin');

    Route::get('/addproduct', function () {
    return view('admin.addproduct'); 
    })->name('addproduct');

    Route::get('/userlist', [admin::class, 'userlist'])->name('userlist');
    Route::post('/storefood', [admin::class, 'storefood'])->name('storefood');
});

