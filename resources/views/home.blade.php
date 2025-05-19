<x-app-layout>
    <section id="hero" class="h-screen relative">
        <div class="absolute inset-0 bg-black opacity-[40%]"></div>
        <img src="{{ asset('/images/home.png') }}" alt="Hero" class="object-cover w-full h-full" />
        <div class="absolute inset-x-0 bottom-0 h-[130px] pointer-events-none bg-gradient-to-t from-gray-100 dark:from-gray-900 to-transparent"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <x-card class="w-[250px] sm:w-[350px] md:w-[500px] lg:w-[650px] font-bold gap-4">
                Cari Tanggal Kunjungan
                <x-button href="#" xw="w-full" xh="h-8" rounded="rounded-md" xtxt="text-sm text-white">
                    Cari Tiket
                </x-button>
            </x-card>
        </div>
    </section>
    <section id="content" rounded="rounded-lg" class="p-16 pt-8 min-h-screen">
        <h1 class="text-3xl font-bold text-center mb-8 text-black dark:text-white">Produk Kami</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <a>
                <x-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/berkuda.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Berkuda</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Nikmati pengalaman berkuda mengelilingi padang rumput yang indah.</p>
                        <h2 class="text-l font-bold">Rp75.000</h2>
                    </div>
                </x-card>
            </a>
            <a>
                <x-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/metik.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Memetik Buah</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Pengalaman memetik buah segar langsung dari kebun.</p>
                        <h2 class="text-l font-bold">Rp50.000</h2>
                    </div>
                </x-card>
            </a>
            <a>
                <x-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/feeding.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Feeding Ternak</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Berinteraksi dan memberi makan ternak dengan pendampingan.</p>
                        <h2 class="text-l font-bold">Rp45.000</h2>
                    </div>
                </x-card>
            </a>
            <a>
                <x-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/berkuda.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Berkuda</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Nikmati pengalaman berkuda mengelilingi padang rumput yang indah.</p>
                        <h2 class="text-l font-bold">Rp75.000</h2>
                    </div>
                </x-card>
            </a>
            <a>
                <x-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/metik.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Memetik Buah</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Pengalaman memetik buah segar langsung dari kebun.</p>
                        <h2 class="text-l font-bold">Rp50.000</h2>
                    </div>
                </x-card>
            </a>
            <a>
                <x-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/feeding.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Feeding Ternak</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Berinteraksi dan memberi makan ternak dengan pendampingan.</p>
                        <h2 class="text-l font-bold">Rp45.000</h2>
                    </div>
                </x-card>
            </a>
            <a>
                <x-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/berkuda.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Berkuda</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Nikmati pengalaman berkuda mengelilingi padang rumput yang indah.</p>
                        <h2 class="text-l font-bold">Rp75.000</h2>
                    </div>
                </x-card>
            </a>
            <a>
                <x-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/metik.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Memetik Buah</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Pengalaman memetik buah segar langsung dari kebun.</p>
                        <h2 class="text-l font-bold">Rp50.000</h2>
                    </div>
                </x-card>
            </a>
        </div>
    </section>
</x-app-layout>