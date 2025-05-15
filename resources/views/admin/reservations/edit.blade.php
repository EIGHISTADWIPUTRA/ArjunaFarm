<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Reservasi') }}
            </h2>
            <a href="{{ route('reservations.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Informasi Pesanan</h3>
                        <div class="mt-2 p-4 bg-gray-50 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Nomor Pesanan:</p>
                                    <p class="font-medium">{{ $reservation->order->order_number }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Pelanggan:</p>
                                    <p class="font-medium">{{ $reservation->order->customer_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Email:</p>
                                    <p class="font-medium">{{ $reservation->order->customer_email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Telepon:</p>
                                    <p class="font-medium">{{ $reservation->order->customer_phone }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Tanggal Kunjungan:</p>
                                    <p class="font-medium">{{ date('d/m/Y', strtotime($reservation->order->visit_date)) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Status Pembayaran:</p>
                                    <p class="font-medium">
                                        @if($reservation->order->payment_status == 'paid')
                                            <span class="text-green-600">Dibayar</span>
                                        @elseif($reservation->order->payment_status == 'pending')
                                            <span class="text-yellow-600">Menunggu</span>
                                        @else
                                            <span class="text-red-600">Dibatalkan</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('reservations.update', $reservation) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="institution_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Institusi</label>
                            <input type="text" name="institution_name" id="institution_name" value="{{ old('institution_name', $reservation->institution_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Isi jika reservasi untuk institusi atau kelompok</p>
                            @error('institution_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="contact_person" class="block text-sm font-medium text-gray-700 mb-1">Kontak Person</label>
                            <input type="text" name="contact_person" id="contact_person" value="{{ old('contact_person', $reservation->contact_person) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Kontak person dari institusi/kelompok</p>
                            @error('contact_person')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                            <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $reservation->notes) }}</textarea>
                            @error('notes')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Perbarui Reservasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
