<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Pesanan: ') . $order->order_number }}
            </h2>
            <a href="{{ route('orders.show', $order) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('orders.update', $order) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Informasi Pelanggan -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pelanggan</h3>

                                <div class="mb-4">
                                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan <span class="text-red-600">*</span></label>
                                    <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $order->customer_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('customer_name')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Email Pelanggan <span class="text-red-600">*</span></label>
                                    <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email', $order->customer_email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('customer_email')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Telepon Pelanggan <span class="text-red-600">*</span></label>
                                    <input type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone', $order->customer_phone) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('customer_phone')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Informasi Pesanan -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pesanan</h3>

                                <div class="mb-4">
                                    <label for="visit_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kunjungan <span class="text-red-600">*</span></label>
                                    <input type="date" name="visit_date" id="visit_date" value="{{ old('visit_date', $order->visit_date->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('visit_date')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran <span class="text-red-600">*</span></label>
                                    <select name="payment_status" id="payment_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                        <option value="pending" {{ old('payment_status', $order->payment_status) == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="paid" {{ old('payment_status', $order->payment_status) == 'paid' ? 'selected' : '' }}>Dibayar</option>
                                        <option value="cancelled" {{ old('payment_status', $order->payment_status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                    @error('payment_status')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <div class="font-medium text-gray-700 mb-1">Total Pesanan</div>
                                    <div class="text-lg font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                    <p class="text-sm text-gray-500">Total tidak dapat diubah. Untuk mengubah item pesanan, harap buat pesanan baru.</p>
                                </div>
                            </div>
                        </div>

                        @if($order->reservation)
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Rombongan</h3>
                            <div class="bg-gray-50 p-4 rounded">
                                <p class="text-gray-600">Informasi rombongan tidak dapat diubah melalui form ini.</p>
                                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">Nama Institusi:</span>
                                        <span class="text-sm text-gray-900">{{ $order->reservation->institution_name }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-500">Kontak:</span>
                                        <span class="text-sm text-gray-900">{{ $order->reservation->contact_person }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Item Pesanan</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Paket
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
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $item->package ? $item->package->name : 'Paket dihapus' }}
                                                </div>
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
                                            <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">
                                                Total:
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Item pesanan tidak dapat diubah. Untuk mengubah item, harap buat pesanan baru.</p>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Perbarui Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
