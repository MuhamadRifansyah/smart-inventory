<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Tambah Barang</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('items.store') }}">
            @csrf

            <div class="mb-4">
                <label>Nama Barang</label>
                <input type="text" name="name" class="border w-full p-2">
            </div>

            <div class="mb-4">
                <label>Kode Barang</label>
                <input type="text" name="code" class="border w-full p-2">
            </div>

            <div class="mb-4">
                <label>Stok</label>
                <input type="number" name="stock" class="border w-full p-2">
            </div>

            <div class="mb-4">
                <label>Unit</label>
                <input type="text" name="unit" class="border w-full p-2">
            </div>

            <button class="px-4 py-2 bg-green-600 text-white rounded">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>
