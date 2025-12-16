<!DOCTYPE html>
<html class="bg-gray-100 dark:bg-gray-900">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name','Smart Inventory') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gray-50 dark:bg-gray-800 p-4">
        <h1 class="text-xl font-bold mb-4">Smart Inventory</h1>

        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('items.index') }}">Items</a>
            <a href="{{ route('items.logs.index') }}">History</a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button>Logout</button>
        </form>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-6">
        {{ $slot }}
    </main>

</div>
</body>
</html>
