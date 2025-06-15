<x-page-layout>
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <h1 class="text-2xl text-gray-900 dark:text-white font-bold mb-2">
        ID Pesanan: AR2025061301
    </h1>
    <h2 class="text-lg text-gray-500 mb-4">
        16 Juni 2025, 10:00
    </h2>
    <x-product-card>
        <ul class="flex flex-col text-sm font-semibold gap-1.5">
            <li class="flex">
                <span class="min-w-[110px]">Nama Lengkap</span>
                <span class="ml-4 break-words">{{ __('Datuk Daneswara Raditya Samsura') }}</span>
            </li>
            <li class="flex">
                <span class="min-w-[110px]">Nomor Telepon</span>
                <span class="ml-4 break-words">{{ __('+62 812-6272-7062') }}</span>
            </li>
            <li class="flex">
                <span class="min-w-[110px]">Email</span>
                <span class="ml-4 break-words">{{ __('daneswara@upi.edu') }}</span>
            </li>
        </ul>
        <hr class="my-4 border-gray-200 dark:border-gray-700">
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pilihan Kegiatan</h3>
                <div class="w-fit bg-[#4CAF5080] px-3 py-1 rounded-md text-sm font-semibold">{{ __('20 Juni 2025') }}</div>
            </div>
            <div class="flex flex-col gap-2">
                <div class="flex w-full p-2.5 items-end justify-between border border-gray-500 rounded-md gap-1.5">
                    <div class="flex flex-col gap-1.5">
                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">
                            Kegiatan 1
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Deskripsi kegiatan 1
                        </p>
                    </div>
                    <span class="text-md font-bold text-gray-900 dark:text-white">
                        1 x Rp100.000
                    </span>
                </div>
                <div class="flex w-full p-2.5 items-end justify-between border border-gray-500 rounded-md gap-1.5">
                    <div class="flex flex-col gap-1.5">
                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">
                            Kegiatan 1
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Deskripsi kegiatan 1
                        </p>
                    </div>
                    <span class="text-md font-bold text-gray-900 dark:text-white">
                        1 x Rp100.000
                    </span>
                </div>
                <div class="flex w-full p-2.5 items-end justify-between border border-gray-500 rounded-md gap-1.5">
                    <div class="flex flex-col gap-1.5">
                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">
                            Kegiatan 1
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Deskripsi kegiatan 1
                        </p>
                    </div>
                    <span class="text-md font-bold text-gray-900 dark:text-white">
                        1 x Rp100.000
                    </span>
                </div>
            </div>
            <div class="flex flex-col gap-1.5">
                <div class="flex items-center justify-between">
                    <h3 class="text-md font-semibold text-gray-500">Subtotal</h3>
                    <span class="text-md font-bold text-gray-500">
                        Rp300.000
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
                        Rp300.000
                    </span>
                </div>
            </div>
        </div>
    </x-product-card>

    <form id="payment-form" method="post" action="{{ route('payment.result') }}" class="flex justify-end mt-4">
        @csrf
        <input type="hidden" name="json_callback" id="json_callback">
        <x-button type="submit" id="pay-button" xw="w-fit" xh="h-fit" xpx="px-4" xpy="py-2" rounded="rounded-xl">
            Lanjutkan Pembayaran
        </x-button>
    </form>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(event) {
            event.preventDefault();
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    document.getElementById('json_callback').value = JSON.stringify(result);
                    document.getElementById('payment-form').submit();
                },
                onPending: function(result) {
                    document.getElementById('json_callback').value = JSON.stringify(result);
                    document.getElementById('payment-form').submit();
                },
                onError: function(result) {
                    document.getElementById('json_callback').value = JSON.stringify(result);
                    document.getElementById('payment-form').submit();
                }
            });
        };
    </script>
</x-page-layout>
