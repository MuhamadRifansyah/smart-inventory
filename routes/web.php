<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemLogController;
use App\Models\Item;
use App\Models\ItemLog;

/*
|--------------------------------------------------------------------------
| Redirect Root
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => redirect()->route('login'));

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard (ADMIN & STAFF)
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {

        $items = Item::all();

        return view('dashboard', [
            'totalItems'  => Item::count(),
            'totalStock'  => Item::sum('stock'),
            'lowStock'    => Item::where('stock', '<', 20)->count(),
            'todayLogs'   => ItemLog::whereDate('created_at', today())->count(),
            'chartLabels' => $items->pluck('name'),
            'chartData'   => $items->pluck('stock'),
        ]);

    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN & STAFF
    |--------------------------------------------------------------------------
    | - Lihat item
    | - Update stok (IN / OUT via log)
    | - Lihat audit log
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin,staff'])->group(function () {

        // READ ONLY ITEMS
        Route::resource('items', ItemController::class)
            ->only(['index','show']);

        // FORM IN / OUT STOK
        Route::get('/items/{item}/adjust', [ItemLogController::class, 'create'])
            ->name('items.adjust');

        Route::post('/items/{item}/adjust', [ItemLogController::class, 'store'])
            ->name('items.adjust.store');

        // AUDIT LOG
        Route::get('/item-logs', [ItemLogController::class, 'index'])
            ->name('items.logs.index');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    | - CRUD item
    | - Bulk delete
    | - Export CSV
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {

        // FULL CRUD (TANPA INDEX & SHOW)
        Route::resource('items', ItemController::class)
            ->except(['index','show']);

        // BULK DELETE
        Route::delete('/items/bulk-delete', [ItemController::class, 'bulkDelete'])
            ->name('items.bulkDelete');

        // EXPORT CSV
        Route::get('/items-export', [ItemController::class, 'exportCsv'])
            ->name('items.export');
    });
});

require __DIR__.'/auth.php';
