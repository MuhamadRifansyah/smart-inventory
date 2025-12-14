<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemLog;
use Illuminate\Http\Request;

class ItemLogController extends Controller
{
    public function index()
    {
        $logs = ItemLog::with(['item', 'user'])
            ->latest()
            ->paginate(10);

        return view('items.logs', compact('logs'));
    }

    public function exportCsv()
    {
        $fileName = 'item_logs_' . date('Y-m-d') . '.csv';

        $logs = ItemLog::with(['item', 'user'])
            ->latest()
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () use ($logs) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, [
                'Tanggal',
                'Barang',
                'User',
                'Tipe',
                'Jumlah',
                'Catatan',
            ]);

            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->created_at->format('Y-m-d H:i:s'),
                    $log->item->name,
                    $log->user->name,
                    strtoupper($log->type),
                    $log->quantity,
                    $log->note,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function create(Item $item)
    {
        return view('items.log', compact('item'));
    }

    public function store(Request $request, Item $item)
    {
        $request->validate([
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        if ($request->type === 'out' && $item->stock < $request->quantity) {
            return back()->withErrors([
                'quantity' => 'Stok tidak cukup',
            ]);
        }

        // Update stok
        if ($request->type === 'in') {
            $item->stock += $request->quantity;
        } else {
            $item->stock -= $request->quantity;
        }

        $item->save();

        // Simpan log
        ItemLog::create([
            'item_id'  => $item->id,
            'user_id'  => auth()->id(),
            'type'     => $request->type,
            'quantity' => $request->quantity,
            'note'     => $request->note,
        ]);

        return redirect()->route('items.index')
            ->with('success', 'Stok berhasil diperbarui');
    }
}
