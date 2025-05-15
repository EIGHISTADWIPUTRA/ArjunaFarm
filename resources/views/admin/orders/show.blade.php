<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Pesanan: ') . $order->order_number }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('orders.edit', $order) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                    Edit Pesanan
                </a>
                <a href="{{ route('orders.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Informasi Pesanan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pesanan</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Nomor Pesanan</h4>
                                <p class="text-base text-gray-900">{{ $order->order_number }}</p>
                            </div>
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Tanggal Pesanan</h4>
                                <p class="text-base text-gray-900">{{ $order->created_at->format('d F Y, H:i') }}</p>
                            </div>
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Tanggal Kunjungan</h4>
                                <p class="text-base text-gray-900">{{ date('d F Y', strtotime($order->visit_date)) }}</p>
                            </div>
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Total Harga</h4>
                                <p class="text-base text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Status Pembayaran</h4>
                                <p class="text-base text-gray-900">
                                    @if($order->payment_status == 'paid')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Dibayar
                                        </span>
                                    @elseif($order->payment_status == 'pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Dibatalkan
                                        </span>
                                    @endif
                                </p>
                            </div>
                            @if($order->qr_code)
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">QR Code</h4>
                                <img src="{{ asset('storage/' . $order->qr_code) }}" alt="QR Code" class="h-24 w-auto mt-1">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Informasi Pelanggan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pelanggan</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Nama</h4>
                                <p class="text-base text-gray-900">{{ $order->customer_name }}</p>
                            </div>
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Email</h4>
                                <p class="text-base text-gray-900">{{ $order->customer_email }}</p>
                            </div>
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Telepon</h4>
                                <p class="text-base text-gray-900">{{ $order->customer_phone }}</p>
                            </div>

                            @if($order->reservation)
                            <div class="mt-4">
                                <h4 class="text-sm font-medium text-gray-500">Informasi Rombongan</h4>
                                <div class="mt-2 grid grid-cols-1 gap-2">
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">Nama Institusi:</span>
                                        <span class="text-sm text-gray-900">{{ $order->reservation->institution_name }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">Kontak:</span>
                                        <span class="text-sm text-gray-900">{{ $order->reservation->contact_person }}</span>
                                    </div>
                                    @if($order->reservation->notes)
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">Catatan:</span>
                                        <p class="text-sm text-gray-900">{{ $order->reservation->notes }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Item Pesanan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Item</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Paket
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tipe
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Harga
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jumlah
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($item->package && $item->package->image)
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $item->package->image) }}" alt="{{ $item->package ? $item->package->name : 'Paket dihapus' }}">
                                                </div>
                                            @endif
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $item->package ? $item->package->name : 'Paket dihapus' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($item->package)
                                            @if($item->package->type == 'personal')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    Personal
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                    Rombongan
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">
                                        Total:
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Informasi Pembayaran -->
            @if($order->payment)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pembayaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500">ID Transaksi</h4>
                            <p class="text-base text-gray-900">{{ $order->payment->midtrans_transaction_id ?? 'N/A' }}</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500">Metode Pembayaran</h4>
                            <p class="text-base text-gray-900">{{ ucfirst($order->payment->payment_type) }}</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500">Jumlah</h4>
                            <p class="text-base text-gray-900">Rp {{ number_format($order->payment->gross_amount, 0, ',', '.') }}</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500">Waktu Transaksi</h4>
                            <p class="text-base text-gray-900">{{ $order->payment->transaction_time->format('d F Y, H:i') }}</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500">Status Transaksi</h4>
                            <p class="text-base text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->payment->transaction_status == 'settlement' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($order->payment->transaction_status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
