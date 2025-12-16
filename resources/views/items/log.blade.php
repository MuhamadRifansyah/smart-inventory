<x-sidebar>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Update Stok: {{ $item->name }}</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('items.log.store', $item) }}">
            @csrf

            <div class="mb-4">
                <label>Tipe</label>
                <select name="type" class="border p-2 w-full">
                    <option value="in">Stok Masuk</option>
                    <option value="out">Stok Keluar</option>
                </select>
            </div>

            <div class="mb-4">
                <label>Jumlah</label>
                <input type="number" name="quantity" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>Catatan</label>
                <textarea name="note" class="border p-2 w-full"></textarea>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</x-sidebar>
