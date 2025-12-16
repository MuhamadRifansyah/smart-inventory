<x-sidebar>
    <h1 class="text-xl font-bold mb-4">
        Update Stok: {{ $item->name }}
    </h1>

    <form method="POST" action="{{ route('items.log.store', $item) }}"
          class="space-y-4 max-w-md">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Tipe Transaksi</label>
        
            <select name="type" class="border rounded px-3 py-2 w-full" required>
                <option value="IN">IN (Tambah Stok)</option>
        
                @if(auth()->user()->role === 'admin')
                    <option value="OUT">OUT (Kurangi Stok)</option>
                @endif
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium">Jumlah</label>
            <input type="number" name="quantity"
                   class="w-full border rounded px-3 py-2"
                   min="1">
            @error('quantity')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button
            class="px-4 py-2 bg-gray-900 text-white rounded">
            Simpan
        </button>
    </form>
</x-sidebar>
