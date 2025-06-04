<x-main-layout>
    <section id="hero" class="h-screen relative">
        <div class="absolute inset-0 bg-black opacity-[40%]"></div>
        <img src="{{ asset('/images/home.png') }}" alt="Hero" class="object-cover w-full h-full" />
        <div class="absolute inset-x-0 bottom-0 h-[130px] pointer-events-none bg-gradient-to-t from-gray-100 dark:from-gray-900 to-transparent"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <x-product-card class="w-[250px] sm:w-[350px] md:w-[500px] lg:w-[650px] font-bold gap-4">
                Cari Tanggal Kunjungan
                <x-text-input></x-text-input>
                <x-button href="#" xw="w-full" xh="h-8" rounded="rounded-md" xtxt="text-sm text-white">
                    Cari Tiket
                </x-button>
            </x-product-card>
        </div>
    </section>
    <section id="about" class="flex px-40 py-8 gap-32">
        <div class="flex flex-col items-center w-full">
            <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="h-[250px] hidden lg:block">
            <img src="{{ asset('/images/text-white.png') }}" alt="Logo Text" class="h-[100px] hidden dark:block">
            <img src="{{ asset('/images/text-black.png') }}" alt="Logo Text" class="h-[100px] dark:hidden block">
        </div>
        <div class="flex flex-col gap-4 w-full">
            <div>
                <h1 class="text-3xl font-bold text-black dark:text-white">Arjuna Farm</h1>
                <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300">Grow Smart, Harvest Heart</h2>
            </div>
            <p class="text-gray-600 dark:text-gray-400">
                Arjuna Farm merupakan media riset teknologi di bidang pertanian dengan pemandangan pesawahan dan danau Situ Cibeureum yang asri. Arjuna Farm telah mengintegrasikan pengairan dan pemupukan pertanian dengan konsep Smart Farming berbasis IoT (Internet of Things)
            </p>
            <ul>
                <li class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 text-primary">
                        <path fill="currentColor" d="M10.6 13.4L8.45 11.25C8.26667 11.0667 8.03333 10.975 7.75 10.975C7.46667 10.975 7.23333 11.0667 7.05 11.25C6.86667 11.4333 6.775 11.6667 6.775 11.95C6.775 12.2333 6.86667 12.4667 7.05 12.65L9.9 15.5C10.1 15.7 10.3333 15.8 10.6 15.8C10.8667 15.8 11.1 15.7 11.3 15.5L16.95 9.85C17.1333 9.66667 17.225 9.43333 17.225 9.15C17.225 8.86667 17.1333 8.63333 16.95 8.45C16.7667 8.26667 16.5333 8.175 16.25 8.175C15.9667 8.175 15.7333 8.26667 15.55 8.45L10.6 13.4ZM5 21C4.45 21 3.97933 20.8043 3.588 20.413C3.19667 20.0217 3.00067 19.5507 3 19V5C3 4.45 3.196 3.97933 3.588 3.588C3.98 3.19667 4.45067 3.00067 5 3H19C19.55 3 20.021 3.196 20.413 3.588C20.805 3.98 21.0007 4.45067 21 5V19C21 19.55 20.8043 20.021 20.413 20.413C20.0217 20.805 19.5507 21.0007 19 21H5Z"/>
                    </svg>
                    Aktivitas Seru dan Edukatif
                </li>
                <li class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 text-primary">
                        <path fill="currentColor" d="M10.6 13.4L8.45 11.25C8.26667 11.0667 8.03333 10.975 7.75 10.975C7.46667 10.975 7.23333 11.0667 7.05 11.25C6.86667 11.4333 6.775 11.6667 6.775 11.95C6.775 12.2333 6.86667 12.4667 7.05 12.65L9.9 15.5C10.1 15.7 10.3333 15.8 10.6 15.8C10.8667 15.8 11.1 15.7 11.3 15.5L16.95 9.85C17.1333 9.66667 17.225 9.43333 17.225 9.15C17.225 8.86667 17.1333 8.63333 16.95 8.45C16.7667 8.26667 16.5333 8.175 16.25 8.175C15.9667 8.175 15.7333 8.26667 15.55 8.45L10.6 13.4ZM5 21C4.45 21 3.97933 20.8043 3.588 20.413C3.19667 20.0217 3.00067 19.5507 3 19V5C3 4.45 3.196 3.97933 3.588 3.588C3.98 3.19667 4.45067 3.00067 5 3H19C19.55 3 20.021 3.196 20.413 3.588C20.805 3.98 21.0007 4.45067 21 5V19C21 19.55 20.8043 20.021 20.413 20.413C20.0217 20.805 19.5507 21.0007 19 21H5Z"/>
                    </svg>
                    Harga Terjangkau
                </li>
                <li class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 text-primary">
                        <path fill="currentColor" d="M10.6 13.4L8.45 11.25C8.26667 11.0667 8.03333 10.975 7.75 10.975C7.46667 10.975 7.23333 11.0667 7.05 11.25C6.86667 11.4333 6.775 11.6667 6.775 11.95C6.775 12.2333 6.86667 12.4667 7.05 12.65L9.9 15.5C10.1 15.7 10.3333 15.8 10.6 15.8C10.8667 15.8 11.1 15.7 11.3 15.5L16.95 9.85C17.1333 9.66667 17.225 9.43333 17.225 9.15C17.225 8.86667 17.1333 8.63333 16.95 8.45C16.7667 8.26667 16.5333 8.175 16.25 8.175C15.9667 8.175 15.7333 8.26667 15.55 8.45L10.6 13.4ZM5 21C4.45 21 3.97933 20.8043 3.588 20.413C3.19667 20.0217 3.00067 19.5507 3 19V5C3 4.45 3.196 3.97933 3.588 3.588C3.98 3.19667 4.45067 3.00067 5 3H19C19.55 3 20.021 3.196 20.413 3.588C20.805 3.98 21.0007 4.45067 21 5V19C21 19.55 20.8043 20.021 20.413 20.413C20.0217 20.805 19.5507 21.0007 19 21H5Z"/>
                    </svg>
                    Fasilitas Makanan dan Minuman
                </li>
            </ul>
            <div class="flex gap-4">
                <x-button href="#" xw="w-full" xh="h-fit" xpy="py-2" xtxt="text-sm text-white">
                    Pesan Tiket
                </x-button>
                <x-button href="wa.me/6282119909719" xw="w-full" xh="h-fit" xpy="py-2" xtxt="text-sm text-white" class="bg-secondary">
                    Hubungi Kami
                </x-button>
            </div>
        </div>
    </section>
    <section id="features" class="px-16 py-8">
        <h1 class="text-3xl font-bold text-center mb-8 text-black dark:text-white">What Do We Have?</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <x-feature-card xp="px-4" rounded="rounded-lg" class="gap-4 items-center">
                <svg viewBox="0 0 75 67" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-12 flex-shrink-0 text-gray-900 dark:text-white">
                    <path fill="currentColor" d="M0.837112 33.2643C0.837112 34.771 2.02908 35.6817 3.50497 35.6817C4.41568 35.6817 5.13756 35.2424 5.76568 34.6143L36.4018 6.70891C36.746 6.36338 37.1237 6.23749 37.5309 6.23749C37.9085 6.23749 38.2541 6.36338 38.6291 6.70891L69.2344 34.6143C69.8934 35.2424 70.6152 35.6817 71.4952 35.6817C72.9697 35.6817 74.163 34.771 74.163 33.2643C74.163 32.3228 73.8175 31.7268 73.2215 31.1924L62.3599 21.3058V2.754C62.3599 1.3732 61.4813 0.494629 60.1005 0.494629H55.9889C54.6389 0.494629 53.6974 1.3732 53.6974 2.754V13.4268L41.2661 2.06293C40.1679 1.02766 38.8179 0.526772 37.5001 0.526772C36.1809 0.526772 34.863 1.029 33.7327 2.06427L1.77863 31.1924C1.21345 31.7268 0.837112 32.3228 0.837112 33.2643ZM9.81435 59.6C9.81435 63.9634 12.4514 66.5067 16.8764 66.5067H29.5902V44.1875C29.5902 42.7437 30.5626 41.8036 32.0063 41.8036H43.0876C44.5313 41.8036 45.4728 42.7437 45.4728 44.1875V66.5067H58.1545C62.5795 66.5067 65.1858 63.9634 65.1858 59.6V36.6232L38.5353 12.6098C38.1898 12.2964 37.8135 12.1397 37.4371 12.1397C37.0916 12.1397 36.746 12.2964 36.3697 12.6419L9.81435 36.7799V59.6Z"/>
                </svg>
                <div class="flex flex-col py-4 gap-2">
                    <h2 class="text-xl font-bold">Smart Farm Education</h2>
                    <p class="text-gray-600 dark:text-gray-400">Edukasi Konsep Smart Farming berbasis IoT (Internet Of Things) serta topologi yang diterapkan.</p>
                </div>
            </x-feature-card>
            <x-feature-card xp="px-4" rounded="rounded-lg" class="gap-4 items-center">
                <svg viewBox="0 0 76 75" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-12 flex-shrink-0 text-gray-900 dark:text-white">
                    <path fill="currentColor" d="M61.2709 3.75C61.2709 1.40625 59.3959 0 57.5209 0H56.5834C48.6146 0 42.5209 8.90625 42.5209 22.0312V26.25C42.5209 30.9375 44.8646 35.1562 49.0834 37.5C47.6771 43.125 47.2084 49.2188 47.2084 49.2188V67.9688C47.2084 71.7188 50.4896 75 54.2396 75C57.9896 75 61.2709 71.7188 61.2709 67.9688V49.2188C61.2709 47.3438 60.8021 42.6562 59.8646 38.4375C60.8021 37.5 61.2709 36.5625 61.2709 35.1562V3.75ZM34.0834 0H33.1459V16.4062C33.1459 17.8125 32.2084 18.75 30.8021 18.75C29.3959 18.75 28.4584 17.8125 28.4584 16.4062V2.34375C28.4584 0.9375 27.5209 0 26.1146 0C24.7084 0 23.7709 0.9375 23.7709 2.34375V16.4062C23.7709 17.8125 22.8334 18.75 21.4271 18.75C20.0209 18.75 19.0834 17.8125 19.0834 16.4062V0H18.1459C16.2709 0 14.3959 1.875 14.3959 3.75V21.0938C14.3959 25.7812 17.2084 30 21.4271 31.875C19.5521 39.375 19.0834 49.2188 19.0834 49.2188V67.9688C19.0834 71.7188 22.3646 75 26.1146 75C29.8646 75 33.1459 71.7188 33.1459 67.9688V49.2188C33.1459 46.875 32.6771 38.4375 31.2709 31.875C35.0209 30 37.8334 25.7812 37.8334 21.0938V3.75C37.8334 1.875 35.9584 0 34.0834 0Z"/>
                </svg>
                <div class="flex flex-col py-4 gap-2">
                    <h2 class="text-xl font-bold">Healthy Cafe</h2>
                    <p class="text-gray-600 dark:text-gray-400">Kami memiliki kafe di tengah kebun dengan menu yang terbuat dari bahan-bahan 100% organik.</p>
                </div>
            </x-feature-card>
            <x-feature-card xp="px-4" rounded="rounded-lg" class="gap-4 items-center">
                <svg viewBox="0 0 75 67" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-12 flex-shrink-0 text-gray-900 dark:text-white">
                    <path fill="currentColor" d="M69.2508 34.1905C68.9634 32.9504 68.4088 31.788 67.6258 30.7843C66.8313 29.7882 65.8287 28.9776 64.6883 28.4093C63.789 27.9668 62.8129 27.7016 61.8133 27.628C61.3039 22.1596 58.8802 17.0466 54.9696 13.1905C50.5166 8.74419 44.4811 6.24683 38.1883 6.24683C31.8956 6.24683 25.86 8.74419 21.4071 13.1905C17.4964 17.0466 15.0727 22.1596 14.5633 27.628C13.5638 27.7016 12.5877 27.9668 11.6883 28.4093C10.5423 28.9688 9.53792 29.7808 8.75083 30.7843C7.96198 31.7858 7.40672 32.9508 7.12559 34.1943C6.84445 35.4377 6.84453 36.7283 7.12583 37.9718L12.0321 58.0655C12.8765 61.1443 14.7114 63.8593 17.2532 65.7911C19.7949 67.7228 22.9021 68.7637 26.0946 68.753H50.1883C53.3917 68.7564 56.5072 67.7056 59.0543 65.7629C61.6013 63.8201 63.4384 61.0933 64.2821 58.003L69.1571 37.9718C69.4696 36.7343 69.5008 35.4405 69.2508 34.1905ZM28.3133 54.253C28.3133 54.8746 28.0664 55.4708 27.6269 55.9103C27.1873 56.3498 26.5912 56.5968 25.9696 56.5968C25.348 56.5968 24.7518 56.3498 24.3123 55.9103C23.8728 55.4708 23.6258 54.8746 23.6258 54.253V41.9405C23.6258 41.3189 23.8728 40.7228 24.3123 40.2832C24.7518 39.8437 25.348 39.5968 25.9696 39.5968C26.5912 39.5968 27.1873 39.8437 27.6269 40.2832C28.0664 40.7228 28.3133 41.3189 28.3133 41.9405V54.253ZM40.5321 54.253C40.5321 54.5608 40.4715 54.8656 40.3537 55.1499C40.2359 55.4343 40.0632 55.6927 39.8456 55.9103C39.628 56.1279 39.3696 56.3006 39.0852 56.4184C38.8009 56.5361 38.4961 56.5968 38.1883 56.5968C37.8805 56.5968 37.5758 56.5361 37.2914 56.4184C37.0071 56.3006 36.7487 56.1279 36.531 55.9103C36.3134 55.6927 36.1408 55.4343 36.023 55.1499C35.9052 54.8656 35.8446 54.5608 35.8446 54.253V41.9405C35.8446 41.3189 36.0915 40.7228 36.531 40.2832C36.9706 39.8437 37.5667 39.5968 38.1883 39.5968C38.8099 39.5968 39.4061 39.8437 39.8456 40.2832C40.2851 40.7228 40.5321 41.3189 40.5321 41.9405V54.253ZM52.7508 54.253C52.7508 54.8746 52.5039 55.4708 52.0644 55.9103C51.6248 56.3498 51.0287 56.5968 50.4071 56.5968C49.7855 56.5968 49.1893 56.3498 48.7498 55.9103C48.3103 55.4708 48.0633 54.8746 48.0633 54.253V41.9405C48.0633 41.3189 48.3103 40.7228 48.7498 40.2832C49.1893 39.8437 49.7855 39.5968 50.4071 39.5968C51.0287 39.5968 51.6248 39.8437 52.0644 40.2832C52.5039 40.7228 52.7508 41.3189 52.7508 41.9405V54.253ZM19.2821 27.5655C19.796 23.3706 21.7121 19.4723 24.7196 16.503C28.2977 12.9421 33.1403 10.9431 38.1883 10.9431C43.2364 10.9431 48.079 12.9421 51.6571 16.503C54.6645 19.4723 56.5806 23.3706 57.0946 27.5655H19.2821Z"/>
                </svg>
                <div class="flex flex-col py-4 gap-2">
                    <h2 class="text-xl font-bold">Farm Stand Market</h2>
                    <p class="text-gray-600 dark:text-gray-400">Setiap panen, stan kami siap melayani. Pengunjung dapat memetik langsung sayuran/buah yang sudah siap panen.</p>
                </div>
            </x-feature-card>
            <x-feature-card xp="px-4" rounded="rounded-lg" class="gap-4 items-center">
                <svg viewBox="0 0 75 67" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-12 flex-shrink-0 text-gray-900 dark:text-white">
                    <path fill="currentColor" d="M53.1251 3.15625L21.8751 3.125C18.4376 3.125 15.6251 5.9375 15.6251 9.375V65.625C15.6251 69.0625 18.4376 71.875 21.8751 71.875H53.1251C56.5626 71.875 59.3751 69.0625 59.3751 65.625V9.375C59.3751 5.9375 56.5626 3.15625 53.1251 3.15625ZM53.1251 59.375H21.8751V15.625H53.1251V59.375Z"/>
                </svg>
                <div class="flex flex-col py-4 gap-2">
                    <h2 class="text-xl font-bold">Smart Garden</h2>
                    <p class="text-gray-600 dark:text-gray-400">Semua pengunjung dapat melihat langsung bagaimana tanaman organik ditanam dan dimonitoring dalam 1 genggaman.</p>
                </div>
            </x-feature-card>
            <x-feature-card xp="px-4" rounded="rounded-lg" class="gap-4 items-center">
                <svg viewBox="0 0 75 67" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-12 flex-shrink-0 text-gray-900 dark:text-white">
                    <path fill="currentColor" d="M22.2084 34.375H28.4584V40.625H22.2084V34.375ZM22.2084 46.875H28.4584V53.125H22.2084V46.875ZM34.7084 34.375H40.9584V40.625H34.7084V34.375ZM34.7084 46.875H40.9584V53.125H34.7084V46.875ZM47.2084 34.375H53.4584V40.625H47.2084V34.375ZM47.2084 46.875H53.4584V53.125H47.2084V46.875Z"/>
                    <path fill="currentColor" d="M15.9584 68.75H59.7084C63.1553 68.75 65.9584 65.9469 65.9584 62.5V18.75C65.9584 15.3031 63.1553 12.5 59.7084 12.5H53.4584V6.25H47.2084V12.5H28.4584V6.25H22.2084V12.5H15.9584C12.5115 12.5 9.70837 15.3031 9.70837 18.75V62.5C9.70837 65.9469 12.5115 68.75 15.9584 68.75ZM59.7084 25L59.7115 62.5H15.9584V25H59.7084Z"/>
                </svg>
                <div class="flex flex-col py-4 gap-2">
                    <h2 class="text-xl font-bold">Seasonal Event And Outbound Flying Fox</h2>
                    <p class="text-gray-600 dark:text-gray-400">Arjuna Farm bisa dijadikan tempat untuk seasonal event seperti acara meeting, outing dan acara lainnya dilengkapi wahana outbound Flying Fox Pertama di Tasikmalaya.</p>
                </div>
            </x-feature-card>
            <x-feature-card xp="px-4" rounded="rounded-lg" class="gap-4 items-center">
                <svg viewBox="0 0 75 67" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-12 flex-shrink-0 text-gray-900 dark:text-white">
                    <path fill="currentColor" d="M13.1665 56.25C11.4478 56.25 9.97692 55.6385 8.754 54.4156C7.53109 53.1927 6.91859 51.7208 6.9165 50V15.625C6.9165 13.9062 7.529 12.4354 8.754 11.2125C9.979 9.98958 11.4498 9.37708 13.1665 9.375H63.1665C64.8853 9.375 66.3571 9.9875 67.5821 11.2125C68.8071 12.4375 69.4186 13.9083 69.4165 15.625V50C69.4165 51.7188 68.805 53.1906 67.5821 54.4156C66.3592 55.6406 64.8873 56.2521 63.1665 56.25H53.7915L55.979 58.4375C56.2915 58.75 56.5259 59.1021 56.6821 59.4938C56.8384 59.8854 56.9165 60.2885 56.9165 60.7031V62.5C56.9165 63.3854 56.6165 64.1271 56.0165 64.725C55.4165 65.3229 54.6748 65.6229 53.7915 65.625H22.5415C21.6561 65.625 20.9144 65.325 20.3165 64.725C19.7186 64.125 19.4186 63.3833 19.4165 62.5V60.7031C19.4165 60.2865 19.4946 59.8833 19.6509 59.4938C19.8071 59.1042 20.0415 58.7521 20.354 58.4375L22.5415 56.25H13.1665ZM13.1665 50H63.1665V15.625H13.1665V50Z"/>
                </svg>
                <div class="flex flex-col py-4 gap-2">
                    <h2 class="text-xl font-bold">Monitoring Keamanan</h2>
                    <p class="text-gray-600 dark:text-gray-400">Edukasi sistem keamanan pertanian menggunakan perangkat terintegrasi dan ramah lingkungan.</p>
                </div>
            </x-feature-card>
        </div>
    </section>
    <section id="content" class="px-16 py-8 min-h-screen">
        <h1 class="text-3xl font-bold text-center mb-8 text-black dark:text-white">Produk Kami</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <a>
                <x-product-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/berkuda.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Berkuda</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Nikmati pengalaman berkuda mengelilingi padang rumput yang indah.</p>
                        <h2 class="text-l font-bold">Rp75.000</h2>
                    </div>
                </x-product-card>
            </a>
            <a>
                <x-product-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/metik.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Memetik Buah</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Pengalaman memetik buah segar langsung dari kebun.</p>
                        <h2 class="text-l font-bold">Rp50.000</h2>
                    </div>
                </x-product-card>
            </a>
            <a>
                <x-product-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/feeding.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Feeding Ternak</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Berinteraksi dan memberi makan ternak dengan pendampingan.</p>
                        <h2 class="text-l font-bold">Rp45.000</h2>
                    </div>
                </x-product-card>
            </a>
            <a>
                <x-product-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/berkuda.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Berkuda</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Nikmati pengalaman berkuda mengelilingi padang rumput yang indah.</p>
                        <h2 class="text-l font-bold">Rp75.000</h2>
                    </div>
                </x-product-card>
            </a>
            <a>
                <x-product-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/metik.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Memetik Buah</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Pengalaman memetik buah segar langsung dari kebun.</p>
                        <h2 class="text-l font-bold">Rp50.000</h2>
                    </div>
                </x-product-card>
            </a>
            <a>
                <x-product-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/feeding.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Feeding Ternak</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Berinteraksi dan memberi makan ternak dengan pendampingan.</p>
                        <h2 class="text-l font-bold">Rp45.000</h2>
                    </div>
                </x-product-card>
            </a>
            <a>
                <x-product-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/berkuda.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Berkuda</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Nikmati pengalaman berkuda mengelilingi padang rumput yang indah.</p>
                        <h2 class="text-l font-bold">Rp75.000</h2>
                    </div>
                </x-product-card>
            </a>
            <a>
                <x-product-card xp="" class="w-full h-full">
                    <img src="{{ asset('/images/metik.jpg') }}" alt="Produk" class="object-fill w-full h-[50%] rounded-t-lg">
                    <div class="flex flex-col p-4 gap-2">
                        <h2 class="text-xl font-bold">Memetik Buah</h2>
                        <p class="text-gray-600 dark:text-gray-400 h-20 overflow-hidden">Pengalaman memetik buah segar langsung dari kebun.</p>
                        <h2 class="text-l font-bold">Rp50.000</h2>
                    </div>
                </x-product-card>
            </a>
        </div>
    </section>
    <section id="location" class="flex p-16 pt-8 gap-16">
        <iframe loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-full h-64 rounded-lg shadow-lg"
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15826.768838028895!2d108.2454078!3d-7.3883462!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5936962ed019%3A0x1a66f58a88bad364!2sArjuna%20Farm!5e0!3m2!1sid!2sid!4v1701657595972!5m2!1sid!2sid">
        </iframe>
        <div class="flex gap-5 w-full text-black dark:text-white">
            <ul class="font-semibold space-y-4">
                <li>ADDRESS</li>
                <li>E-MAIL</li>
                <li>SITE</li>
                <li>PHONE</li>
            </ul>
            <ul class="space-y-4">
                <li>Situ Cibeureum Kota Tasikmalaya</li>
                <li>arjunafarmtasik@gmail.com</li>
                <li>http://www.arjunafarm.id</li>
                <li>082119909719</li>
            </ul>
        </div>
    </section>
</x-main-layout>