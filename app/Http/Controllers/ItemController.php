<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    public function exportCsv()
{
    $fileName = 'items_' . date('Y-m-d') . '.csv';

    $items = Item::all();

    $headers = [
        "Content-Type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
    ];

    $callback = function () use ($items) {
        $file = fopen('php://output', 'w');

        // Header CSV
        fputcsv($file, ['Name', 'Code', 'Stock', 'Unit', 'Created At']);

        foreach ($items as $item) {
            fputcsv($file, [
                $item->name,
                $item->code,
                $item->stock,
                $item->unit,
                $item->created_at,
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

    {
        $items = Item::latest()->paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'code'  => 'required|string|max:50|unique:items,code',
            'stock' => 'required|integer|min:0',
            'unit'  => 'nullable|string|max:50',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')
            ->with('success', 'Item berhasil ditambahkan');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'code'  => 'required|string|max:50|unique:items,code,' . $item->id,
            'stock' => 'required|integer|min:0',
            'unit'  => 'nullable|string|max:50',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')
            ->with('success', 'Item berhasil diupdate');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item berhasil dihapus');
    }
}
