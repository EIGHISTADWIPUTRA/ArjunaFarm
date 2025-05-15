@extends('layouts.app')

@section('content')
    <!-- Hero Section dengan Form Pemesanan -->
    @include('components.hero-section')

    <!-- Featured Activities Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-8">Aktivitas Terpopuler</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Activity Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="/images/activities/activity-1.jpg" alt="Activity 1" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Berkuda</h3>
                        <p class="text-gray-600 mb-4">Nikmati pengalaman berkuda mengelilingi padang rumput yang indah.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-red-500 font-bold">Rp 75.000</span>
                            <a href="#" class="text-blue-600 hover:underline">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Activity Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="/images/activities/activity-2.jpg" alt="Activity 2" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Memetik Buah</h3>
                        <p class="text-gray-600 mb-4">Pengalaman memetik buah segar langsung dari kebun.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-red-500 font-bold">Rp 50.000</span>
                            <a href="#" class="text-blue-600 hover:underline">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Activity Card 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="/images/activities/activity-3.jpg" alt="Activity 3" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Feeding Ternak</h3>
                        <p class="text-gray-600 mb-4">Berinteraksi dan memberi makan ternak dengan pendampingan.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-red-500 font-bold">Rp 45.000</span>
                            <a href="#" class="text-blue-600 hover:underline">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="#" class="inline-block bg-red-500 text-white px-6 py-3 rounded-lg font-medium hover:bg-red-600 transition">Lihat Semua Aktivitas</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script untuk datepicker akan dijalankan dari app.js
    });
</script>
@endpush
