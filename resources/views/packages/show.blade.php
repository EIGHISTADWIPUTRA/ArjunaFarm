@extends('layouts.app')

@section('content')
    <div class="relative">
        <img src="{{ Storage::url($package->image) }}" alt="{{ $package->name }}" class="w-full h-96 object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
        <div class="container mx-auto px-4 relative -mt-32 mb-16">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 md:p-8">
                    <h1 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800">{{ $package->name }}</h1>
                    <div class="flex flex-wrap gap-4 mb-6">
                        <div class="flex items-center text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Min {{ $package->min_participants }} peserta
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            {{ ucfirst($package->type) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="md:w-2/3">
                <div class="bg-white rounded-lg shadow-md p-6 md:p-8 mb-8">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">Deskripsi Paket</h2>
                    <div class="prose max-w-none text-gray-700">
                        {{ $package->description }}
                    </div>

                    <h3 class="text-xl font-bold mt-8 mb-4 text-gray-800">Yang Termasuk</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Tur terpandu implementasi Smart Farming berbasis IoT</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Pengamatan langsung budidaya tanaman organik</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Demonstrasi teknologi pemantauan tanaman</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Cemilan 100% organik dari Kafe Sehat kami</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="md:w-1/3">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-20">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800 text-center">Pesan Paket Ini</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                            <span class="text-gray-600">Harga Reguler:</span>
                            <span class="text-xl font-bold text-gray-800">{{ $package->getFormattedPrice() }}</span>
                        </div>

                        @if($package->discount_percentage > 0)
                            <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                                <span class="text-gray-600">Diskon:</span>
                                <span class="text-green-600 font-semibold">{{ $package->discount_percentage }}%</span>
                            </div>

                            <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                                <span class="text-gray-600">Harga Akhir:</span>
                                <span class="text-2xl font-bold text-green-600">{{ $package->getFormattedDiscountedPrice() }}</span>
                            </div>
                        @endif
                    </div>

                    <a href="{{ route('orders.create', ['package_id' => $package->id]) }}" class="block w-full bg-green-600 hover:bg-green-700 text-white text-center font-bold py-3 px-4 rounded-lg transition">
                        Pesan Sekarang
                    </a>

                    <div class="mt-6 text-sm text-gray-600 space-y-2">
                        <p><span class="font-semibold">Tipe Paket:</span> {{ ucfirst($package->type) }}</p>
                        <p><span class="font-semibold">Minimal Peserta:</span> {{ $package->min_participants }}</p>
                        <p class="text-amber-700"><span class="font-semibold">Catatan:</span> Pemesanan harus dilakukan minimal 3 hari sebelum tanggal kunjungan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
