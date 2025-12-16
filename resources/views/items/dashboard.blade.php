<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    <div class="bg-white rounded-xl p-6 shadow
    transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">


        <!-- Total Item -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl p-6 shadow hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Total Barang</p>
                    <h2 class="text-3xl font-bold">{{ $totalItems }}</h2>
                </div>
                <svg class="w-10 h-10 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 7l9-4 9 4-9 4-9-4z" />
                </svg>
            </div>
        </div>

        <!-- Total Stock -->
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl p-6 shadow hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Total Stok</p>
                    <h2 class="text-3xl font-bold">{{ $totalStock }}</h2>
                </div>
                <svg class="w-10 h-10 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 6v12m6-6H6" />
                </svg>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-xl p-6 shadow hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Stok Rendah</p>
                    <h2 class="text-3xl font-bold">{{ $lowStock }}</h2>
                    <p class="text-xs opacity-80">&lt; 20</p>
                </div>
                <svg class="w-10 h-10 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3m0 4h.01M5.93 19h12.14c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L4.2 16c-.77 1.33.19 3 1.73 3z" />
                </svg>
            </div>
        </div>

        <!-- Activity -->
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl p-6 shadow hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Aktivitas Hari Ini</p>
                    <h2 class="text-3xl font-bold">{{ $todayLogs }}</h2>
                </div>
                <svg class="w-10 h-10 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>

    </div>
</x-app-layout>
<script>
    console.log('Dashboard JS OK');
    console.log(window.Swal);
    console.log(window.Chart);
</script>

