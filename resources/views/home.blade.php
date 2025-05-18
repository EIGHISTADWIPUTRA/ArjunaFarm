<x-app-layout>
    <section id="hero" class="h-screen relative">
        <div class="absolute inset-0 bg-black opacity-[40%]"></div>
        <img src="{{ asset('/images/home.png') }}" alt="Hero" class="object-cover w-full h-full" />
        <div class="absolute inset-x-0 bottom-0 h-[130px] pointer-events-none bg-gradient-to-t from-gray-100 dark:from-gray-900 to-transparent"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <x-card class="w-[250px] sm:w-[350px] md:w-[500px] lg:w-[650px] font-bold gap-4">
                Cari Tanggal Kunjungan
                <x-button href="#" xw="w-full" xh="h-8" rounded="rounded-md" xtxt="text-sm">
                    Cari Tiket
                </x-button>
            </x-card>
        </div>
    </section>
    <section id="content">
        <div class="flex flex-col items-center justify-center h-screen">
            <h1 class="text-4xl font-bold text-white">Selamat Datang di Aplikasi Reservasi</h1>
            <p class="mt-4 text-lg text-white">Nikmati kemudahan dalam melakukan reservasi.</p>
            <x-button href="{{ route('register') }}" xw="w-[130px]" xh="h-[45px]" class="mt-6">
                Daftar Sekarang
            </x-button>
        </div>
    </section>
</x-app-layout>