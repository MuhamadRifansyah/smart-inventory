<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Smart Inventory') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
<div class="flex min-h-screen">

    <!-- SIDEBAR -->
  <!-- SIDEBAR -->
<aside class="w-64 bg-gray-50 text-gray-900 flex flex-col border-r border-gray-200">
    <!-- LOGO -->
    <div class="px-6 py-5 text-xl font-bold border-b border-gray-200">
        Smart Inventory
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-3 py-4 space-y-1">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center px-4 py-2 rounded-md transition
           {{ request()->routeIs('dashboard')
              ? 'bg-gray-200 font-semibold'
              : 'hover:bg-gray-100' }}">
            Dashboard
        </a>

        <!-- Items -->
        <a href="{{ route('items.index') }}"
           class="flex items-center px-4 py-2 rounded-md transition
           {{ request()->routeIs('items.*')
              ? 'bg-gray-200 font-semibold'
              : 'hover:bg-gray-100' }}">
            Items
        </a>

        <!-- History -->
        <a href="{{ route('items.logs.index') }}"
           class="flex items-center px-4 py-2 rounded-md transition
           {{ request()->routeIs('items.logs.*')
              ? 'bg-gray-200 font-semibold'
              : 'hover:bg-gray-100' }}">
            History
        </a>
    </nav>
<!-- 🌙 DARK MODE TOGGLE (INI YANG TADI GA ADA) -->
<div class="px-4 py-4 border-t border-gray-200 dark:border-gray-700">
    <button onclick="toggleDarkMode()"
        class="w-full px-4 py-2 rounded
               bg-gray-200 dark:bg-gray-700
               hover:bg-gray-300 dark:hover:bg-gray-600
               transition">
        <span class="dark:hidden">🌙 Dark Mode</span>
        <span class="hidden dark:inline">☀️ Light Mode</span>
    </button>
    <!-- LOGOUT -->
    <form method="POST" action="{{ route('logout') }}"
          class="p-4 border-t border-gray-200">
        @csrf
        <button
            class="w-full text-left px-4 py-2 rounded-md
                   text-gray-700 hover:bg-gray-100 transition font-medium">
            Logout
        </button>
    </form>
</aside>



    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6">
        <div class="bg-white rounded-lg shadow p-6">
            {{ $slot }}
        </div>
    </main>

</div>
</body>
</html>
