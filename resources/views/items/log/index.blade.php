<x-sidebar>
    <h1 class="text-2xl font-bold mb-6">Audit Log Stok</h1>
    
    {{-- FILTER --}}
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3 mb-6">
    
        <select name="item_id" class="border px-3 py-2 rounded">
            <option value="">Semua Item</option>
            @foreach($items as $item)
                <option value="{{ $item->id }}"
                    {{ request('item_id') == $item->id ? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    
        <select name="user_id" class="border px-3 py-2 rounded">
            <option value="">Semua User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}"
                    {{ request('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    
        <input type="date" name="from" value="{{ request('from') }}"
               class="border px-3 py-2 rounded">
    
        <input type="date" name="to" value="{{ request('to') }}"
               class="border px-3 py-2 rounded">
    
        <button class="bg-gray-900 text-white rounded px-4 py-2">
            Filter
        </button>
    </form>
    
    <div class="bg-white border rounded-lg overflow-x-auto">
    <table class="w-full text-sm">
    <thead class="bg-gray-100">
    <tr>
        <th class="px-3 py-2">Waktu</th>
        <th class="px-3 py-2">User</th>
        <th class="px-3 py-2">Item</th>
        <th class="px-3 py-2 text-center">Tipe</th>
        <th class="px-3 py-2 text-center">Qty</th>
        <th class="px-3 py-2 text-center">Sebelum</th>
        <th class="px-3 py-2 text-center">Sesudah</th>
    </tr>
    </thead>
    
    <tbody class="divide-y">
    @forelse($logs as $log)
    <tr>
        <td class="px-3 py-2">
            {{ $log->created_at->format('d M Y H:i') }}
        </td>
        <td class="px-3 py-2">
            {{ $log->user->name ?? '-' }}
        </td>
        <td class="px-3 py-2">
            {{ $log->item->name ?? '-' }}
        </td>
        <td class="px-3 py-2 text-center">
            <span class="px-2 py-1 rounded text-xs
                {{ $log->type === 'IN'
                    ? 'bg-green-100 text-green-700'
                    : 'bg-red-100 text-red-700' }}">
                {{ $log->type }}
            </span>
        </td>
        <td class="px-3 py-2 text-center">{{ $log->quantity }}</td>
        <td class="px-3 py-2 text-center">{{ $log->stock_before }}</td>
        <td class="px-3 py-2 text-center font-semibold">{{ $log->stock_after }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="7" class="text-center py-6 text-gray-500">
            Tidak ada data
        </td>
    </tr>
    @endforelse
    </tbody>
    </table>
    </div>
    
    <div class="mt-4">
        {{ $logs->links() }}
    </div>
    </x-sidebar>
    