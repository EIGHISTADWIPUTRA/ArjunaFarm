@extends('layouts.app')

@section('content')
    <section class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 bg-green-600 text-white">
                    <h1 class="text-2xl font-bold">Selesaikan Pembayaran Anda</h1>
                </div>

                <div class="p-6">
                    <div class="mb-8">
                        <div class="flex flex-col md:flex-row items-center justify-center gap-2 md:gap-4 mb-6">
                            <div class="flex items-center text-gray-400">
                                <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold mr-2">1</div>
                                <span class="font-semibold">Isi Data</span>
                            </div>
                            <div class="hidden md:block text-gray-300">→</div>
                            <div class="flex items-center text-green-600">
                                <div class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center font-bold mr-2">2</div>
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
                        <div class="md:col-span-2 order-last md:order-first">
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h3 class="text-lg font-semibold mb-4 text-gray-800">Ringkasan Pesanan</h3>
                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Nomor Pesanan</span>
                                        <span class="font-semibold">{{ $order->order_number }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Tanggal Kunjungan</span>
                                        <span class="font-semibold">{{ $order->visit_date->format('l, d F Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Informasi Pemesan</span>
                                        <div class="text-right">
                                            <p class="font-semibold">{{ $order->customer_name }}</p>
                                            <p class="text-sm text-gray-600">{{ $order->customer_email }}</p>
                                            <p class="text-sm text-gray-600">{{ $order->customer_phone }}</p>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4 border-gray-300">

                                <h3 class="text-lg font-semibold mb-4 text-gray-800">Detail Paket</h3>
                                <div class="space-y-4">
                                    @foreach($orderItems as $item)
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <p class="font-semibold">{{ $item->package->name }}</p>
                                                <p class="text-sm text-gray-600">{{ $item->quantity }} peserta</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }}</p>
                                                <p class="font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="flex justify-between items-center pt-4 border-t border-gray-300">
                                        <span class="font-bold text-gray-800">Total Pembayaran</span>
                                        <span class="font-bold text-xl text-green-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-1">
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h3 class="text-lg font-semibold mb-4 text-gray-800">Pilih Metode Pembayaran</h3>

                                <div class="space-y-4 mb-6">
                                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" class="h-4 w-4 text-green-600 focus:ring-green-500" checked>
                                        <span class="ml-2">Transfer Bank</span>
                                    </label>

                                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" class="h-4 w-4 text-green-600 focus:ring-green-500">
                                        <span class="ml-2">E-Wallet</span>
                                    </label>

                                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" class="h-4 w-4 text-green-600 focus:ring-green-500">
                                        <span class="ml-2">Virtual Account</span>
                                    </label>
                                </div>

                                <button id="pay-button" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition">
                                    Bayar Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        // This is where you'd integrate with your payment gateway
        document.getElementById('pay-button').onclick = function() {
            // For demo purposes, we'll just redirect to the confirmation page
            // In a real implementation, this would open the payment gateway
            window.location.href = "{{ route('orders.confirmation', $order->order_number) }}";
        };
    </script>
    @endpush
@endsection
