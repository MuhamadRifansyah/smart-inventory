<nav x-data="{ open: false }"
     class="bg-white dark:bg-gray-800
            border-b border-gray-100 dark:border-gray-700
            transition-colors duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left -->
            <div class="flex items-center gap-6">

                <a href="{{ route('dashboard') }}"
                   class="text-lg font-bold
                          text-gray-800 dark:text-gray-100">
                    Smart Inventory
                </a>

                <div class="hidden sm:flex gap-4">
                    <a href="{{ route('dashboard') }}"
                       class="text-sm px-3 py-2 rounded
                              {{ request()->routeIs('dashboard')
                                  ? 'bg-gray-200 dark:bg-gray-700'
                                  : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('items.index') }}"
                       class="text-sm px-3 py-2 rounded
                              {{ request()->routeIs('items.*')
                                  ? 'bg-gray-200 dark:bg-gray-700'
                                  : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        Items
                    </a>
                </div>
            </div>

            <!-- Right -->
            <div class="hidden sm:flex items-center gap-4">

                <!-- Dark Mode Toggle -->
                <button onclick="toggleDarkMode()"
                        class="px-3 py-2 rounded
                               bg-gray-200 dark:bg-gray-700
                               text-gray-800 dark:text-gray-100
                               hover:bg-gray-300 dark:hover:bg-gray-600
                               transition">
                    <span class="dark:hidden">🌙</span>
                    <span class="hidden dark:inline">☀️</span>
                </button>

                <!-- User -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="px-3 py-2 rounded
                               hover:bg-red-500 hover:text-white
                               transition">
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </div>
</nav>
