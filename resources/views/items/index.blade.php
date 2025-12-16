<x-sidebar>
    <h1 class="text-2xl font-bold mb-6">Items</h1>
    
    {{-- SEARCH --}}
    <form method="GET" class="flex gap-4 mb-4">
        <input name="search"
               value="{{ request('search') }}"
               class="border px-3 py-2 rounded w-64"
               placeholder="Cari nama / kode">
    
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="low_stock" value="1"
                   {{ request('low_stock') ? 'checked' : '' }}>
            Stok rendah
        </label>
    
        <button class="px-4 py-2 bg-gray-900 text-white rounded">
            Filter
        </button>
    </form>
    
    {{-- BULK FORM (ADMIN ONLY) --}}
    @if(auth()->user()->role === 'admin')
    <form id="bulkForm" method="POST" action="{{ route('items.bulkDelete') }}">
        @csrf
        @method('DELETE')
    @endif
    
    <div class="mb-4 flex gap-3">
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('items.create') }}"
           class="px-4 py-2 bg-gray-900 text-white rounded">
            + Tambah Barang
        </a>
    
        <button type="button"
                onclick="confirmBulkDelete()"
                class="px-4 py-2 bg-red-600 text-white rounded">
            Hapus Terpilih
        </button>
        @endif
    
        <a href="{{ route('items.logs.index') }}"
           class="px-4 py-2 bg-gray-200 rounded">
            History
        </a>
    </div>
    
    <div class="bg-white border rounded-lg overflow-x-auto">
    <table class="w-full text-sm">
    <thead class="bg-gray-100">
    <tr>
    @if(auth()->user()->role === 'admin')
    <th class="px-3 text-center">
        <input type="checkbox" onclick="toggleAll(this)">
    </th>
    @endif
    <th class="px-3">Nama</th>
    <th class="px-3">Kode</th>
    <th class="px-3 text-center">Stok</th>
    <th class="px-3 text-right">Aksi</th>
    </tr>
    </thead>
    
    <tbody class="divide-y">
    @forelse($items as $item)
    <tr>
    @if(auth()->user()->role === 'admin')
    <td class="px-3 text-center">
        <input type="checkbox" name="ids[]" value="{{ $item->id }}">
    </td>
    @endif
    
    <td class="px-3">{{ $item->name }}</td>
    <td class="px-3">{{ $item->code }}</td>
    <td class="px-3 text-center font-semibold">{{ $item->stock }}</td>
    
    <td class="px-3 text-right">
    @if(auth()->user()->role === 'admin')
    <button onclick="confirmDelete('{{ route('items.destroy',$item) }}')"
            class="text-red-600 hover:underline">
        Hapus
    </button>
    @else
    <span class="text-gray-400">-</span>
    @endif
    </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center py-6 text-gray-500">
            Tidak ada data
        </td>
    </tr>
    @endforelse
    </tbody>
    </table>
    </div>
    
    @if(auth()->user()->role === 'admin')
    </form>
    @endif
    
    <script>
    function toggleAll(src){
        document.querySelectorAll('[name="ids[]"]').forEach(c=>{
            c.checked = src.checked
        })
    }
    
    function confirmBulkDelete(){
        const checked = document.querySelectorAll('[name="ids[]"]:checked')
        if(checked.length === 0){
            alert('Pilih item dulu')
            return
        }
        if(confirm(`Hapus ${checked.length} item?`)){
            document.getElementById('bulkForm').submit()
        }
    }
    
    function confirmDelete(url){
        if(confirm('Hapus item ini?')){
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
    }
    </script>
    </x-sidebar>
    