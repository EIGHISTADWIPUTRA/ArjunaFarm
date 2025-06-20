<x-page-layout>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
        <strong class="font-bold">Pembayaran Berhasil!</strong>
        <span class="block sm:inline">Terima kasih atas pembayaran Anda.</span>
    </div>

    <h1 class="text-2xl text-gray-900 dark:text-white font-bold mb-2">
        ID Pesanan: {{ $result['order_id'] }}
    </h1>
    <h2 class="text-lg text-gray-500 mb-4">
        {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }}
    </h2>
    <x-product-card>
        <ul class="flex flex-col text-sm font-semibold gap-1.5">
            <li class="flex">
                <span class="min-w-[110px]">Status</span>
                <span class="ml-4 break-words font-bold text-green-600">
                    @if($result['transaction_status'] == 'settlement' || $result['transaction_status'] == 'capture')
                        LUNAS
                    @elseif($result['transaction_status'] == 'pending')
                        MENUNGGU PEMBAYARAN
                    @else
                        {{ strtoupper($result['transaction_status']) }}
                    @endif
                </span>
            </li>
            <li class="flex">
                <span class="min-w-[110px]">Metode Pembayaran</span>
                <span class="ml-4 break-words">{{ $result['payment_type'] ?? '-' }}</span>
            </li>
            <li class="flex">
                <span class="min-w-[110px]">Waktu Transaksi</span>
                <span class="ml-4 break-words">{{ \Carbon\Carbon::parse($result['transaction_time'])->setTimezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }}</span>
            </li>
        </ul>
        <hr class="my-4 border-gray-200 dark:border-gray-700">
        
        <div class="flex flex-col gap-1.5 mt-4">
            @php
                // Retrieve transaction details from database for this order_id
                $transaction = \App\Models\Transaction::where('order_id', str_replace('AR', '', $result['order_id']))->first();
                if ($transaction) {
                    $details = DB::table('transaction_details as td')
                        ->select('td.transaction_id', 'p.name', 'p.description', 'p.price', 'td.quantity')
                        ->where('td.transaction_id', $transaction->id)
                        ->join('products as p', 'td.product_id', '=', 'p.id')
                        ->get();
                }
            @endphp

            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Pesanan</h3>
                <div class="w-fit bg-[#4CAF5080] px-3 py-1 rounded-md text-sm font-semibold">{{ __('20 Juni 2025') }}</div>
            </div>

            @if(isset($transaction) && isset($details))
                <div class="flex flex-col gap-2">
                    @php $subtotal = 0; @endphp
                    @foreach ($details as $detail)
                        @php $subtotal += $detail->quantity * $detail->price @endphp
                        <div class="flex w-full p-2.5 items-end justify-between border border-gray-500 rounded-md gap-1.5">
                            <div class="flex flex-col gap-1.5">
                                <h3 class="text-md font-semibold text-gray-900 dark:text-white">
                                    {{ $detail->name }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $detail->description }}
                                </p>
                            </div>
                            <span class="text-md font-bold text-gray-900 dark:text-white">
                                {{ $detail->quantity }} x Rp{{ number_format($detail->price, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach
                </div>
                <div class="flex flex-col gap-1.5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-md font-semibold text-gray-500">Subtotal</h3>
                        <span class="text-md font-bold text-gray-500">
                            {{ 'Rp' . number_format($subtotal, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <h3 class="text-md font-semibold text-gray-500">Diskon</h3>
                        <span class="text-md font-bold text-gray-500">
                            Rp0
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total</h3>
                        <span class="text-lg font-bold text-gray-900 dark:text-white">
                            {{ 'Rp' . number_format($transaction->total_amount, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            @else
                <div class="text-center p-4">
                    <span class="text-gray-500">Detail pesanan tidak tersedia</span>
                </div>
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total</h3>
                    <span class="text-lg font-bold text-gray-900 dark:text-white">
                        {{ 'Rp' . number_format($result['gross_amount'], 0, ',', '.') }}
                    </span>
                </div>
            @endif
        </div>
    </x-product-card>    <div class="flex justify-between mt-4">
        
        <x-button xw="w-fit" xh="h-fit" xpx="px-4" xpy="py-2" rounded="rounded-xl" onclick="window.print()">
            Cetak Bukti Pembayaran
        </x-button>
    </div>

    <div class="flex justify-center mt-8">
        <x-button href="{{ route('home') }}" xw="w-fit" xh="h-fit" xpx="px-4" xpy="py-2" rounded="rounded-xl" color="secondary">
            Kembali ke Beranda
        </x-button>
    </div>
</x-page-layout>
