<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemLogController extends Controller
{
    /**
     * FORM UPDATE STOK
     */
    public function create(Item $item)
    {
        return view('items.log.create', compact('item'));
    }

    /**
     * SIMPAN LOG + UPDATE STOK (PAKAI TRANSAKSI)
     */
    public function store(Request $request, Item $item)
    {
        $request->validate([
            'type'     => 'required|in:IN,OUT',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // 🔒 ROLE RULE (ANTI NAKAL)
        if (auth()->user()->role === 'staff' && $request->type === 'OUT') {
            abort(403, 'Staff tidak diizinkan mengurangi stok');
        }
    
        $before = $item->stock;
        $qty    = $request->quantity;
    
        $after = $request->type === 'IN'
            ? $before + $qty
            : $before - $qty;
    
        if ($after < 0) {
            return back()->with('error', 'Stok tidak mencukupi');
        }
    
        // 🔥 TRANSAKSI DATABASE (AMAN DATA)
        DB::transaction(function () use ($item, $request, $before, $after, $qty) {
    
            $item->update([
                'stock' => $after
            ]);
    
            ItemLog::create([
                'item_id'      => $item->id,
                'user_id'      => auth()->id(),
                'type'         => $request->type,
                'quantity'     => $qty,
                'stock_before' => $before,
                'stock_after'  => $after,
            ]);
        });
    
        return redirect()
            ->route('items.index')
            ->with('success', 'Stok berhasil diupdate');
    }

    /**
     * 🔥 HISTORY / AUDIT LOG + FILTER
     */
    public function index(Request $request)
    {
        $logs = ItemLog::with(['item','user'])
            ->when($request->filled('item_id'), function ($q) use ($request) {
                $q->where('item_id', $request->item_id);
            })
            ->when($request->filled('user_id'), function ($q) use ($request) {
                $q->where('user_id', $request->user_id);
            })
            ->when($request->filled('from'), function ($q) use ($request) {
                $q->whereDate('created_at', '>=', $request->from);
            })
            ->when($request->filled('to'), function ($q) use ($request) {
                $q->whereDate('created_at', '<=', $request->to);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('items.log.index', [
            'logs'  => $logs,
            'items' => Item::all(),
            'users' => User::all(),
        ]);
    }
}
