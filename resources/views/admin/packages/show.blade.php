<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Paket: ') . $package->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('packages.edit', $package) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                    Edit Paket
                </a>
                <a href="{{ route('packages.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Gambar Paket -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Gambar Paket</h3>
                        @if ($package->image)
                            <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->name }}" class="w-full h-auto rounded">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded">
                                <span class="text-gray-500">Tidak ada gambar</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Informasi Utama -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-2">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Paket</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">Nama Paket</h4>
                                    <p class="text-base text-gray-900">{{ $package->name }}</p>
                                </div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">Tipe Paket</h4>
                                    <p class="text-base text-gray-900">
                                        @if ($package->type == 'personal')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Personal
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                Rombongan
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">Harga</h4>
                                    <p class="text-base text-gray-900">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                                </div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">Persentase Diskon</h4>
                                    <p class="text-base text-gray-900">{{ $package->discount_percentage }}%</p>
                                </div>
                            </div>
                            <div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">Harga Setelah Diskon</h4>
                                    <p class="text-base text-gray-900">Rp {{ number_format($package->discounted_price, 0, ',', '.') }}</p>
                                </div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">Minimal Peserta</h4>
                                    <p class="text-base text-gray-900">{{ $package->min_participants }} orang</p>
                                </div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">Status</h4>
                                    <p class="text-base text-gray-900">
                                        @if ($package->is_active)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">Terakhir Diperbarui</h4>
                                    <p class="text-base text-gray-900">{{ $package->updated_at->format('d F Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-3">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Deskripsi</h3>
                        <div class="prose max-w-none">
                            <p class="text-gray-700">{{ $package->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
