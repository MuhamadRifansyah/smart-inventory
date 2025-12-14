<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemLogController;

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

    /*
    |--------------------------------------------------------------------------
    | Admin Only
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', function () {
            return 'Admin Area';
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Admin & Staff
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin,staff'])->group(function () {

        // CRUD Items
        Route::resource('items', ItemController::class);

        // Export CSV
        Route::get('/items-export', [ItemController::class, 'exportCsv'])
            ->name('items.export');

        // Stock Log
        Route::get('/items/{item}/log', [ItemLogController::class, 'create'])
            ->name('items.log.create');

        Route::post('/items/{item}/log', [ItemLogController::class, 'store'])
            ->name('items.log.store');
    });
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
