<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemLog;

class DashboardController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('dashboard', [
            'totalItems'  => Item::count(),
            'totalStock'  => Item::sum('stock'),
            'lowStock'    => Item::where('stock', '<', 20)->count(),
            'todayLogs'   => ItemLog::whereDate('created_at', today())->count(),

            // 🔥 CHART DATA
            'chartLabels' => $items->pluck('name'),
            'chartData'   => $items->pluck('stock'),

            // optional KPI tambahan
            'totalIn'     => ItemLog::where('type', 'IN')->count(),
            'totalOut'    => ItemLog::where('type', 'OUT')->count(),
        ]);
    }
}
