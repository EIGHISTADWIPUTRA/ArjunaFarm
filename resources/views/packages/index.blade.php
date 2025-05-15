@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-green-800 text-white">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/packages-hero.jpg'); opacity: 0.6;"></div>
        <div class="container mx-auto px-4 py-16 relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Paket Wisata Edukasi</h1>
            <p class="text-xl">Temukan berbagai paket wisata edukasi dan rekreasi kami</p>
        </div>
    </section>

    <!-- Package Listing Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row -mx-4">
                <!-- Filter Sidebar -->
                <div class="md:w-1/4 px-4 mb-8 md:mb-0">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold mb-6 text-gray-800">Filter Paket</h2>

                        <form action="{{ route('packages.index') }}" method="GET" class="space-y-6">
                            <div class="space-y-4">
                                <h3 class="font-semibold text-gray-700">Tipe Paket</h3>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="type" value="" class="h-4 w-4 text-green-600" {{ !request('type') ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">Semua Tipe</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="type" value="personal" class="h-4 w-4 text-green-600" {{ request('type') == 'personal' ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">Personal</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="type" value="rombongan" class="h-4 w-4 text-green-600" {{ request('type') == 'rombongan' ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">Rombongan</span>
                                    </label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <h3 class="font-semibold text-gray-700">Rentang Harga</h3>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-sm text-gray-600">Harga Min (Rp)</label>
                                        <input type="number" name="price_min" value="{{ request('price_min') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-600">Harga Max (Rp)</label>
                                        <input type="number" name="price_max" value="{{ request('price_max') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition">
                                Terapkan Filter
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Packages Grid -->
                <div class="md:w-3/4 px-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($packages as $package)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                                <img src="{{ Storage::url($package->image) }}" alt="{{ $package->name }}" class="w-full h-48 object-cover">
                                <div class="p-6">
                                    <h3 class="text-xl font-bold mb-2 text-gray-800">{{ $package->name }}</h3>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($package->description, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-green-600">{{ $package->getFormattedPrice() }}</span>
                                        <a href="{{ route('packages.show', $package) }}" class="inline-block text-green-600 hover:text-green-700 font-semibold">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($packages->isEmpty())
                        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-6 rounded-lg text-center">
                            <p class="text-lg font-semibold">Tidak ada paket yang sesuai dengan filter Anda.</p>
                            <p class="mt-2">Silakan coba mengubah kriteria filter Anda.</p>
                        </div>
                    @endif

                    <div class="mt-8">
                        {{ $packages->appends($filters)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
