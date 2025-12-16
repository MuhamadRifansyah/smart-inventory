<x-sidebar>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Barang</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('items.update', $item) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Nama Barang</label>
                <input type="text" name="name"
                       value="{{ $item->name }}"
                       class="border w-full p-2">
            </div>

            <div class="mb-4">
                <label>Kode Barang</label>
                <input type="text" name="code"
                       value="{{ $item->code }}"
                       class="border w-full p-2">
            </div>

            <div class="mb-4">
                <label>Stok</label>
                <input type="number" name="stock"
                       value="{{ $item->stock }}"
                       class="border w-full p-2">
            </div>

            <div class="mb-4">
                <label>Unit</label>
                <input type="text" name="unit"
                       value="{{ $item->unit }}"
                       class="border w-full p-2">
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Update
            </button>
        </form>
    </div>
</x-sidebar>
