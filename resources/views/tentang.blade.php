<x-main-layout>
    <section class="flex flex-col px-4 md:px-16 lg:px-40 py-4 gap-8">
        <div class="flex flex-col items-center justify-center w-full gap-2 mb-6 mt-28">
            <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="h-[120px] md:h-[150px] lg:h-[200px]">
            <img src="{{ asset('/images/text-white.png') }}" alt="Logo Text" class="h-[60px] md:h-[100px] hidden dark:block">
            <img src="{{ asset('/images/text-black.png') }}" alt="Logo Text" class="h-[60px] md:h-[100px] dark:hidden block">
        </div>
        <div class="flex flex-col gap-4 w-full">
            <h1 class="text-3xl font-bold text-black dark:text-white mb-2">Tentang Kami</h1>
            <p class="text-gray-600 dark:text-gray-400">
                Arjuna Farm adalah media riset dan edukasi berbasis teknologi di bidang pertanian, perkebunan, dan perikanan. Terletak di kawasan pesawahan dan danau Situ Cibeureum yang asri, Arjuna Farm menghadirkan solusi pertanian modern melalui penerapan teknologi Smart Farming berbasis Internet of Things (IoT).
            </p>
            <p class="text-gray-600 dark:text-gray-400">
                Kami berkomitmen menghadirkan pertanian masa depan dengan memanfaatkan perangkat pintar, sensor canggih, dan sistem monitoring digital untuk menciptakan ekosistem pertanian yang efisien, berkelanjutan, dan mudah diakses oleh siapa saja.
            </p>
            <p class="text-gray-600 dark:text-gray-400">
                Arjuna Farm lahir dari semangat perubahan—dari kebun tradisional menjadi percontohan Smart Farm yang menggabungkan teknologi, wisata edukatif, dan pemberdayaan masyarakat.
            </p>
            <h2 class="text-2xl font-semibold text-white mt-8 mb-2">Visi</h2>
            <p class="text-gray-600 dark:text-gray-400">
                Menjadi pusat edukasi Smart Farming, Smart Home, Smart Village, dan Smart Feeding yang memperkenalkan teknologi perangkat pintar untuk mengoptimalkan hasil pertanian dan operasional secara modern dan efisien.
            </p>
            <h2 class="text-2xl font-semibold text-white mt-8 mb-2">Misi</h2>
            <ul class="list-disc pl-6 mb-4 text-gray-600 dark:text-gray-400">
                <li>Menjadi pelopor Smart Farming di Kota Tasikmalaya.</li>
                <li>Menjadi tempat edukasi terbuka bagi petani, pelajar, ibu rumah tangga, dan masyarakat umum.</li>
                <li>Mengoptimalkan pemanfaatan lahan non-produktif melalui solusi teknologi berbasis IoT.</li>
                <li>Meningkatkan kualitas dan kuantitas hasil panen melalui sistem pertanian pintar.</li>
            </ul>
            <h2 class="text-2xl font-semibold text-white mt-8 mb-2">Apa yang Kami Tawarkan</h2>
            <ul class="list-disc pl-6 mb-4 text-gray-600 dark:text-gray-400">
                <li>Sistem irigasi dan nutrisi otomatis berbasis IoT.</li>
                <li>Media tanam modern seperti hidroponik, cocopeat, dan rakit apung.</li>
                <li>Monitoring suhu, kelembaban, kualitas air, dan pertumbuhan tanaman secara real-time.</li>
                <li>Edukasi langsung bagi pengunjung dalam bentuk wisata teknologi pertanian.</li>
                <li>Pengolahan data untuk analisis pertumbuhan tanaman dan optimasi hasil panen.</li>
            </ul>
            <h2 class="text-2xl font-semibold text-white mt-8 mb-2">Dukungan & Legalitas</h2>
            <p class="text-gray-600 dark:text-gray-400">
                Kami beroperasi di bawah naungan CV. Teknologi Perangkat Pintar, dengan izin resmi dan Nomor Induk Berusaha (NIB) yang sah. Arjuna Farm juga telah menerima berbagai kunjungan dan testimoni positif dari pemerintahan daerah, tokoh nasional, hingga komunitas pendidikan dan pertanian.
            </p>
            <h2 class="text-2xl font-semibold text-white mt-8 mb-2">Lokasi & Kontak</h2>
            <section id="location" class="flex flex-col md:flex-row lg:flex-row p-4 md:p-8 lg:p-16 pt-8 gap-8 md:gap-16">
                <iframe loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-full h-64 rounded-lg shadow-lg"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15826.768838028895!2d108.2454078!3d-7.3883462!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5936962ed019%3A0x1a66f58a88bad364!2sArjuna%20Farm!5e0!3m2!1sid!2sid!4v1701657595972!5m2!1sid!2sid">
                </iframe>
                <div class="flex gap-5 w-full text-black dark:text-white">
                    <div class="w-full">
                        <ul class="font-semibold space-y-4">
                            <li class="flex">
                                <span class="min-w-[80px]">ADDRESS</span>
                                <span class="ml-4 break-words">Situ Cibeureum Kota Tasikmalaya</span>
                            </li>
                            <li class="flex">
                                <span class="min-w-[80px]">E-MAIL</span>
                                <span class="ml-4 break-words">arjunafarmtasik@gmail.com</span>
                            </li>
                            <li class="flex">
                                <span class="min-w-[80px]">SITE</span>
                                <span class="ml-4 break-words">http://www.arjunafarm.id</span>
                            </li>
                            <li class="flex">
                                <span class="min-w-[80px]">PHONE</span>
                                <span class="ml-4 break-words">082119909719</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </section>
</x-main-layout>
