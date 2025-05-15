<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Reservasi') }}
            </h2>
            <div>
                <a href="{{ route('reservations.edit', $reservation) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mr-2">
                    Edit
                </a>
                <a href="{{ route('reservations.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Informasi Reservasi -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Informasi Reservasi</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-md font-medium text-gray-700 mb-2">Detail Reservasi</h4>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="mb-3">
                                    <p class="text-sm text-gray-500">Kode Pesanan:</p>
                                    <p class="font-medium">{{ $reservation->order->order_number }}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-sm text-gray-500">Dibuat Pada:</p>
                                    <p class="font-medium">{{ date('d/m/Y H:i', strtotime($reservation->created_at)) }}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-sm text-gray-500">Institusi:</p>
                                    <p class="font-medium">{{ $reservation->institution_name ?: 'Personal' }}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-sm text-gray-500">Kontak Person:</p>
                                    <p class="font-medium">{{ $reservation->contact_person ?: '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Catatan:</p>
                                    <p class="font-medium">{{ $reservation->notes ?: '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-md font-medium text-gray-700 mb-2">Informasi Pelanggan</h4>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="mb-3">
                                    <p class="text-sm text-gray-500">Nama:</p>
                                    <p class="font-medium">{{ $reservation->order->customer_name }}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-sm text-gray-500">Email:</p>
                                    <p class="font-medium">{{ $reservation->order->customer_email }}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-sm text-gray-500">Telepon:</p>
                                    <p class="font-medium">{{ $reservation->order->customer_phone }}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-sm text-gray-500">Tanggal Kunjungan:</p>
                                    <p class="font-medium">{{ date('d/m/Y', strtotime($reservation->order->visit_date)) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Status Pembayaran:</p>
                                    <p class="font-medium">
                                        @if($reservation->order->payment_status == 'paid')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Dibayar</span>
                                        @elseif($reservation->order->payment_status == 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Pesanan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Detail Pesanan</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paket</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Satuan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($reservation->order->orderItems as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->package->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ ucfirst($item->package->type) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $item->quantity }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-medium">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-right font-medium">Total:</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900">Rp {{ number_format($reservation->order->total_price, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
