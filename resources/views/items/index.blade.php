<x-sidebar>
    <h1 class="text-2xl font-bold mb-6">Items</h1>

    {{-- FORM BULK DELETE --}}
    <form id="bulkForm" method="POST" action="{{ route('items.bulkDelete') }}">
        @csrf
        @method('DELETE')

        <!-- ACTION BAR -->
        <div class="flex flex-wrap gap-3 mb-4">

            <a href="{{ route('items.create') }}"
               class="px-4 py-2 bg-gray-900 text-white rounded">
                + Tambah Barang
            </a>

            @if(auth()->user()->role === 'admin')
            <button type="button"
                    onclick="bulkDelete()"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Hapus Terpilih
            </button>
            @endif

            <a href="{{ route('items.export') }}"
               class="px-4 py-2 bg-gray-200 rounded">
                Export CSV
            </a>

            <a href="{{ route('items.logs.index') }}"
               class="px-4 py-2 bg-gray-200 rounded">
                History Stok
            </a>
        </div>

        <!-- SEARCH -->
        <div class="flex gap-4 mb-4">
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari nama atau kode..."
                   class="px-4 py-2 border rounded w-64">

            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="low_stock" value="1"
                       {{ request('low_stock') ? 'checked' : '' }}>
                Stok rendah
            </label>

            <button class="px-4 py-2 bg-gray-900 text-white rounded">
                Filter
            </button>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto bg-white border rounded-lg">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        @if(auth()->user()->role === 'admin')
                        <th class="px-4 py-3 text-center">
                            <input type="checkbox" onclick="toggleAll(this)">
                        </th>
                        @endif
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3 text-center">Stok</th>
                        <th class="px-4 py-3">Unit</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                @forelse($items as $item)
                    <tr class="hover:bg-gray-50">

                        @if(auth()->user()->role === 'admin')
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" name="ids[]" value="{{ $item->id }}">
                        </td>
                        @endif

                        <td class="px-4 py-3">{{ $item->name }}</td>
                        <td class="px-4 py-3">{{ $item->code }}</td>
                        <td class="px-4 py-3 text-center font-semibold">{{ $item->stock }}</td>
                        <td class="px-4 py-3">{{ $item->unit }}</td>

                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 text-xs rounded
                                {{ $item->stock < 20 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                {{ $item->stock < 20 ? 'LOW' : 'OK' }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('items.edit', $item) }}">Edit</a>

                            @if(auth()->user()->role === 'admin')
                            <button type="button"
                                    onclick="confirmSingleDelete('{{ route('items.destroy',$item) }}')"
                                    class="text-red-600">
                                Hapus
                            </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                            Belum ada data
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="p-4">
                {{ $items->links() }}
            </div>
        </div>
    </form>

    {{-- JAVASCRIPT --}}
    <script>
        function toggleAll(source) {
            document.querySelectorAll('input[name="ids[]"]').forEach(cb => {
                cb.checked = source.checked
            })
        }

        function bulkDelete() {
            const checked = document.querySelectorAll('input[name="ids[]"]:checked')

            if (checked.length === 0) {
                Swal.fire('Pilih item dulu', '', 'info')
                return
            }

            Swal.fire({
                title: `Hapus ${checked.length} item?`,
                text: 'Data tidak bisa dikembalikan',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then(res => {
                if (res.isConfirmed) {
                    document.getElementById('bulkForm').submit()
                }
            })
        }

        function confirmSingleDelete(url) {
            Swal.fire({
                title: 'Hapus item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya'
            }).then(res => {
                if (res.isConfirmed) {
                    const f = document.createElement('form')
                    f.method = 'POST'
                    f.action = url
                    f.innerHTML = `
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                    `
                    document.body.appendChild(f)
                    f.submit()
                }
            })
        }
    </script>
</x-sidebar>
