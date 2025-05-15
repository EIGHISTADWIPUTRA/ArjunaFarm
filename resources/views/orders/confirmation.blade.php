@extends('layouts.app')

@section('content')
    <section class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-center justify-center gap-2 md:gap-4 mb-6">
                        <div class="flex items-center text-gray-400">
                            <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold mr-2">1</div>
                            <span class="font-semibold">Isi Data</span>
                        </div>
                        <div class="hidden md:block text-gray-300">→</div>
                        <div class="flex items-center text-gray-400">
                            <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold mr-2">2</div>
                            <span class="font-semibold">Pembayaran</span>
                        </div>
                        <div class="hidden md:block text-gray-300">→</div>
                        <div class="flex items-center text-green-600">
                            <div class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center font-bold mr-2">3</div>
                            <span class="font-semibold">Konfirmasi</span>
                        </div>
                    </div>

                    <div class="text-center mb-8">
                        @if($order->payment_status === 'paid')
                            <div class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold mb-2 text-gray-800">Pemesanan Berhasil!</h2>
                            <p class="text-gray-600">Pemesanan Anda telah dikonfirmasi dan e-tiket Anda sudah siap.</p>
                        @else
                            <div class="w-20 h-20 mx-auto bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold mb-2 text-gray-800">Pemesanan Tertunda</h2>
                            <p class="text-gray-600">Pemesanan Anda menunggu konfirmasi pembayaran.</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold mb-4 text-gray-800">Detail Pemesanan</h3>
                            <div class="bg-gray-50 rounded-lg p-6 space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Nomor Pemesanan</span>
                                    <span class="font-semibold">{{ $order->order_number }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status Pembayaran</span>
                                    <span class="font-semibold {{ $order->payment_status === 'paid' ? 'text-green-600' : 'text-yellow-600' }}">
                                        @if($order->payment_status === 'paid')
                                            Lunas
                                        @else
                                            Menunggu Pembayaran
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tanggal Kunjungan</span>
                                    <span class="font-semibold">{{ $order->visit_date->format('l, d F Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Pemesan</span>
                                    <span class="font-semibold">{{ $order->customer_name }}</span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-lg font-semibold mb-4 text-gray-800">Detail Paket</h3>
                                <div class="bg-gray-50 rounded-lg p-6 space-y-4">
                                    @foreach($orderItems as $item)
                                        <div class="flex justify-between">
                                            <div>
                                                <span class="font-semibold">{{ $item->package->name }}</span>
                                                <p class="text-sm text-gray-600">{{ $item->quantity }} peserta</p>
                                            </div>
                                            <span class="font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                        </div>
                                    @endforeach

                                    <div class="pt-4 border-t border-gray-300 flex justify-between">
                                        <span class="font-bold text-gray-800">Total</span>
                                        <span class="font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($order->payment_status === 'paid')
                            <div>
                                <h3 class="text-lg font-semibold mb-4 text-gray-800">E-Tiket Anda</h3>
                                <div class="bg-gray-50 rounded-lg p-6 text-center">
                                    @if($order->qr_code)
                                        <div class="mb-4">
                                            <img src="{{ Storage::url($order->qr_code) }}" alt="E-Ticket QR Code" class="mx-auto h-40">
                                        </div>
                                    @endif
                                    <p class="text-gray-600 mb-4">Tunjukkan QR code ini di pintu masuk pada hari kunjungan Anda.</p>
                                    <a href="{{ route('tickets.download', $order->order_number) }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition">
                                        Unduh E-Tiket
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="{{ $order->payment_status === 'paid' ? 'md:col-span-2' : '' }}">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800">Petunjuk Kunjungan</h3>
                            <div class="bg-gray-50 rounded-lg p-6">
                                <ul class="list-disc list-inside space-y-2 text-gray-700">
                                    <li>Harap tiba 15 menit sebelum tur terjadwal Anda dimulai.</li>
                                    <li>Kenakan pakaian dan alas kaki yang nyaman untuk kegiatan pertanian.</li>
                                    <li>Jangan lupa membawa topi dan tabir surya untuk kegiatan di luar ruangan.</li>
                                    <li>Anak-anak harus selalu diawasi oleh orang dewasa.</li>
                                    <li>Perkebunan kami terletak di Jl. Raya Cibeuti KM 4, Kota Tasikmalaya.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('home') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
