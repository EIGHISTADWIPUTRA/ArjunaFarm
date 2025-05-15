<!-- Navbar -->
<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <img src="/images/logo/logo.png" alt="Arjuna Farm Logo" class="h-14 w-auto">
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex items-center space-x-4">
                <a href="#" class="text-gray-700 hover:text-green-600 px-3 py-2 font-medium">Aktivitas</a>
                <a href="#" class="text-gray-700 hover:text-green-600 px-3 py-2 font-medium">Reservasi</a>
                <a href="#" class="text-gray-700 hover:text-green-600 px-3 py-2 font-medium">Tentang</a>
                <a href="{{ route('tiket') }}" class="btn-red">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                    </svg>
                    Beli Tiket
                </a>
            </div>
        </div>
    </div>
</nav>
