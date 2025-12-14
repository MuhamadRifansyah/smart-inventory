<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Daftar Barang
        </h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('items.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded">
            + Tambah Barang
        </a>

        @if(session('success'))
            <div class="mt-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('items.export') }}"
        class="ml-2 px-4 py-2 bg-green-600 text-white rounded">
         Export CSV
     </a>
     
        <table class="mt-6 w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Kode</th>
                    <th class="border p-2">Stok</th>
                    <th class="border p-2">Unit</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td class="border p-2">{{ $item->name }}</td>
                    <td class="border p-2">{{ $item->code }}</td>
                    <td class="border p-2">{{ $item->stock }}</td>
                    <td class="border p-2">{{ $item->unit }}</td>
                    <td class="border p-2">
                        <a href="{{ route('items.edit', $item) }}" class="text-blue-600">
                            Edit
                        </a>

                        <form action="{{ route('items.destroy', $item) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus item?')"
                                    class="text-red-600 ml-2">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $items->links() }}
        </div>
    </div>
</x-app-layout>
