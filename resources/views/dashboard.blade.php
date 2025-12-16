<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        {{-- TOTAL BARANG --}}
        <div class="bg-white rounded-xl p-6 shadow
                    transition hover:shadow-lg hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Barang</p>
                    <p class="text-3xl font-bold mt-1">{{ $totalItems }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- TOTAL STOK --}}
        <div class="bg-white rounded-xl p-6 shadow
                    transition hover:shadow-lg hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Stok</p>
                    <p class="text-3xl font-bold mt-1">{{ $totalStock }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10h18M9 16h6" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- STOK RENDAH --}}
        <div class="bg-white rounded-xl p-6 shadow
                    transition hover:shadow-lg hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Stok Rendah</p>
                    <p class="text-3xl font-bold mt-1 text-red-600">{{ $lowStock }}</p>
                    <p class="text-xs text-gray-400">&lt; 20</p>
                </div>
                <div class="p-3 bg-red-100 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01M12 3l9 18H3L12 3z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- AKTIVITAS --}}
        <div class="bg-white rounded-xl p-6 shadow
                    transition hover:shadow-lg hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Aktivitas Hari Ini</p>
                    <p class="text-3xl font-bold mt-1">{{ $todayLogs }}</p>
                </div>
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4l3 3" />
                    </svg>
                </div>
            </div>
        </div>

    </div>

    {{-- CHART --}}
    <div class="bg-white rounded-xl p-6 shadow">
        <h3 class="font-semibold mb-4">Stok Barang</h3>
    
        @if ($chartLabels->count())
            <div class="h-72">
                <canvas id="stockChart"></canvas>
            </div>
        @else
            <div class="h-64 flex flex-col items-center justify-center text-gray-400">
                <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6" />
                </svg>
                <p>Belum ada data stok</p>
            </div>
        @endif
    </div>
    
    @if ($chartLabels->count())
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('stockChart')
    
        const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300)
        gradient.addColorStop(0, '#60a5fa')
        gradient.addColorStop(1, '#2563eb')
    
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Jumlah Stok',
                    data: @json($chartData),
                    backgroundColor: gradient,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: ctx => `Stok: ${ctx.raw}`
                        }
                    },
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        })
    })
    </script>
    @endif
    
</x-app-layout>
