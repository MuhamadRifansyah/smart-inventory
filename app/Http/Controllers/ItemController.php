<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * LIST ITEMS + SEARCH + FILTER
     */
    public function index(Request $request)
    {
        $query = Item::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%');
            });
        }

        // Low stock filter
        if ($request->boolean('low_stock')) {
            $query->where('stock', '<', 20);
        }

        $items = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('items.index', compact('items'));
    }

    /**
     * CREATE FORM (ADMIN)
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * STORE ITEM (ADMIN)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'code'  => 'required|string|max:50|unique:items,code',
            'stock' => 'required|integer|min:0',
            'unit'  => 'nullable|string|max:50',
        ]);

        Item::create($request->only([
            'name', 'code', 'stock', 'unit'
        ]));

        return redirect()
            ->route('items.index')
            ->with('success', 'Item berhasil ditambahkan');
    }

    /**
     * EDIT FORM (ADMIN)
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * UPDATE ITEM (ADMIN)
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'code'  => 'required|string|max:50|unique:items,code,' . $item->id,
            'stock' => 'required|integer|min:0',
            'unit'  => 'nullable|string|max:50',
        ]);

        $item->update($request->only([
            'name', 'code', 'stock', 'unit'
        ]));

        return redirect()
            ->route('items.index')
            ->with('success', 'Item berhasil diupdate');
    }

    /**
     * DELETE SINGLE ITEM (ADMIN ONLY)
     */
    public function destroy(Item $item)
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('success', 'Item berhasil dihapus');
    }

    /**
     * 🔥 BULK DELETE (ADMIN ONLY)
     */
    public function bulkDelete(Request $request)
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $ids = $request->input('ids');

        if (!$ids || !is_array($ids)) {
            return redirect()
                ->route('items.index')
                ->with('error', 'Tidak ada item dipilih');
        }

        Item::whereIn('id', $ids)->delete();

        return redirect()
            ->route('items.index')
            ->with('success', count($ids) . ' item berhasil dihapus');
    }
}
