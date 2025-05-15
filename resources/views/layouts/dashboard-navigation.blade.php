<!-- Navbar Dashboard -->
<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <img src="/images/logo/logo.png" alt="Arjuna Farm Logo" class="h-14 w-auto">
                </div>
                <div class="ml-4 text-xl font-bold text-gray-800">Admin Dashboard</div>
            </div>

            <!-- Right Navigation -->
            <div class="flex items-center space-x-4">
                <span class="text-gray-700 px-3 py-2">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-red-600 px-3 py-2 font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>