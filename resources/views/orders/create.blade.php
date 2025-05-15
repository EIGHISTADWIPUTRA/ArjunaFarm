@extends('layouts.app')

@section('content')
    <section class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 bg-green-600 text-white">
                    <h1 class="text-2xl font-bold">Pesan Kunjungan Anda</h1>
                </div>

                <div class="p-6">
                    <div class="mb-8">
                        <div class="flex flex-col md:flex-row items-center justify-center gap-2 md:gap-4 mb-6">
                            <div class="flex items-center text-green-600">
                                <div class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center font-bold mr-2">1</div>
                                <span class="font-semibold">Isi Data</span>
                            </div>
                            <div class="hidden md:block text-gray-300">→</div>
                            <div class="flex items-center text-gray-400">
                                <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold mr-2">2</div>
                                <span class="font-semibold">Pembayaran</span>
                            </div>
                            <div class="hidden md:block text-gray-300">→</div>
                            <div class="flex items-center text-gray-400">
                                <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold mr-2">3</div>
                                <span class="font-semibold">Konfirmasi</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-1 order-last md:order-first">
                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <h3 class="text-lg font-semibold mb-4 text-gray-800">Ringkasan Paket</h3>
                                <div class="flex flex-col space-y-4">
                                    <div>
                                        <img src="{{ Storage::url($package->image) }}" alt="{{ $package->name }}" class="w-full h-32 object-cover rounded-lg">
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">{{ $package->name }}</h4>
                                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($package->description, 100) }}</p>
                                        <div class="flex justify-between mt-3">
                                            <div class="text-sm text-gray-600">
                                                Harga:
                                                <div>
                                                    <span class="text-lg font-bold text-green-600">Rp {{ number_format($package->getDiscountedPrice(), 0, ',', '.') }}</span>
                                                    @if($package->discount_percentage > 0)
                                                        <span class="text-xs text-gray-500 line-through">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="text-right text-sm text-gray-600">
                                                <div>
                                                    Tipe:
                                                    <span class="font-semibold">{{ ucfirst($package->type) }}</span>
                                                </div>
                                                <div>
                                                    Min Peserta:
                                                    <span class="font-semibold">{{ $package->min_participants }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <form action="{{ route('orders.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="package_id" value="{{ $package->id }}">
                                <input type="hidden" name="package_type" value="{{ $package->type }}">

                                <div>
                                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Informasi Kunjungan</h3>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label for="visit_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kunjungan *</label>
                                        <input type="date" id="visit_date" name="visit_date" min="{{ date('Y-m-d', strtotime('+3 days')) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('visit_date') @enderror"
                                            value="{{ old('visit_date') }}">
                                        @error('visit_date')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                        <p class="text-xs text-gray-500 mt-1">Silakan pesan minimal 3 hari sebelumnya</p>
                                    </div>

                                    <div>
                                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Peserta *</label>
                                        <input type="number" id="quantity" name="quantity" min="{{ $package->min_participants }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('quantity') @enderror"
                                            value="{{ old('quantity', $package->min_participants) }}">
                                        @error('quantity')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                        <p class="text-xs text-gray-500 mt-1">Minimal {{ $package->min_participants }} peserta</p>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold mb-4 text-gray-800 border-t pt-4">Informasi Pemesan</h3>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                                        <input type="text" id="customer_name" name="customer_name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('customer_name') @enderror"
                                            value="{{ old('customer_name') }}">
                                        @error('customer_name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email *</label>
                                        <input type="email" id="customer_email" name="customer_email"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('customer_email') @enderror"
                                            value="{{ old('customer_email') }}">
                                        @error('customer_email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon *</label>
                                        <input type="tel" id="customer_phone" name="customer_phone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('customer_phone') @enderror"
                                            value="{{ old('customer_phone') }}">
                                        @error('customer_phone')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                @if($package->type === 'rombongan')
                                    <div>
                                        <h3 class="text-lg font-semibold mb-4 text-gray-800 border-t pt-4">Informasi Rombongan</h3>
                                    </div>

                                    <div class="space-y-4">
                                        <div>
                                            <label for="institution_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Institusi *</label>
                                            <input type="text" id="institution_name" name="institution_name"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('institution_name') @enderror"
                                                value="{{ old('institution_name') }}">
                                            @error('institution_name')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="contact_person" class="block text-sm font-medium text-gray-700 mb-1">Nama Contact Person *</label>
                                            <input type="text" id="contact_person" name="contact_person"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('contact_person') @enderror"
                                                value="{{ old('contact_person') }}">
                                            @error('contact_person')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                                    <textarea id="notes" name="notes" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('notes') @enderror">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition">
                                        Lanjut ke Pembayaran
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
