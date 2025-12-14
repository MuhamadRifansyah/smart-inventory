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

        // validasi stok
        if ($request->type === 'out' && $item->stock < $request->quantity) {
            return back()->withErrors([
                'quantity' => 'Stok tidak cukup'
            ]);
        }

        // update stok
        if ($request->type === 'in') {
            $item->stock += $request->quantity;
        } else {
            $item->stock -= $request->quantity;
        }

        $item->save();

        // SIMPAN LOG (INI YANG TADI KURANG TUTUP)
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
