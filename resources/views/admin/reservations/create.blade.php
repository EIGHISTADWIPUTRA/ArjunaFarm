<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Reservasi Baru') }}
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
                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="order_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Pesanan <span class="text-red-600">*</span></label>
                            <select name="order_id" id="order_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Pilih pesanan...</option>
                                @foreach($orders as $order)
                                    <option value="{{ $order->id }}" {{ old('order_id') == $order->id ? 'selected' : '' }}>
                                        {{ $order->order_number }} - {{ $order->customer_name }} ({{ date('d/m/Y', strtotime($order->visit_date)) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('order_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="institution_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Institusi</label>
                            <input type="text" name="institution_name" id="institution_name" value="{{ old('institution_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Isi jika reservasi untuk institusi atau kelompok</p>
                            @error('institution_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="contact_person" class="block text-sm font-medium text-gray-700 mb-1">Kontak Person</label>
                            <input type="text" name="contact_person" id="contact_person" value="{{ old('contact_person') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Kontak person dari institusi/kelompok</p>
                            @error('contact_person')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                            <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                            @error('notes')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Simpan Reservasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
