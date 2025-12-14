<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
/*
|--------------------------------------------------------------------------
| Root Redirect
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin only
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', function () {
            return 'Admin Area';
        });
    });

    // Admin & Staff
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::get('/items', function () {
            return 'Item List';
        });
    });
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::resource('items', ItemController::class);
    });

});

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
