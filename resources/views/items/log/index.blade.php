<x-sidebar>
<h1 class="text-2xl font-bold mb-6">History Stok (Audit Log)</h1>

<div class="bg-white border rounded-lg overflow-x-auto">
<table class="w-full text-sm">
<thead class="bg-gray-100">
<tr>
    <th class="px-4 py-2">Tanggal</th>
    <th class="px-4 py-2">User</th>
    <th class="px-4 py-2">Barang</th>
    <th class="px-4 py-2 text-center">Tipe</th>
    <th class="px-4 py-2 text-center">Qty</th>
    <th class="px-4 py-2 text-center">Sebelum</th>
    <th class="px-4 py-2 text-center">Sesudah</th>
</tr>
</thead>

<tbody>
@forelse($logs as $log)
<tr class="border-t">
    <td class="px-4 py-2">{{ $log->created_at->format('d M Y H:i') }}</td>
    <td class="px-4 py-2">{{ $log->user->name }}</td>
    <td class="px-4 py-2">{{ $log->item->name }}</td>
    <td class="px-4 py-2 text-center">
        <span class="px-2 py-1 text-xs rounded
            {{ $log->type === 'IN' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
            {{ $log->type }}
        </span>
    </td>
    <td class="px-4 py-2 text-center">{{ $log->quantity }}</td>
    <td class="px-4 py-2 text-center">{{ $log->stock_before }}</td>
    <td class="px-4 py-2 text-center font-semibold">{{ $log->stock_after }}</td>
</tr>
@empty
<tr>
    <td colspan="7" class="text-center py-6 text-gray-500">
        Belum ada history
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
