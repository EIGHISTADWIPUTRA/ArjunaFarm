@props(['transparent' => true])

<nav class="flex justify-between py-2 px-8 lg:py-4 lg:px-16 fixed w-full z-10 transition-all duration-300 ease-in-out {{ $transparent ? 'bg-transparent' : 'bg-white dark:bg-gray-800 shadow-lg' }}">
    <!-- Logo -->
    <div class="block lg:hidden"></div>
    <div class="flex items-center">
        <a href="/" class="flex items-center gap-2">
            <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="h-[65px] hidden lg:block">
            <img src="{{ asset('/images/text-white.png') }}" alt="Logo Text" class="h-[65px] hidden dark:block">
            <img src="{{ asset('/images/text-black.png') }}" alt="Logo Text" class="h-[65px] dark:hidden block">
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="flex items-center gap-8 hidden lg:flex">
        <div class="flex items-center space-x-8">
            <a href="#" class="text-[#707070] hover:text-black dark:hover:text-white transition-all duration-300 ease-in-out">Aktivitas</a>
            <a href="#" class="text-[#707070] hover:text-black dark:hover:text-white transition-all duration-300 ease-in-out">Reservasi</a>
            <a href="#" class="text-[#707070] hover:text-black dark:hover:text-white transition-all duration-300 ease-in-out">Tentang</a>
        </div>
        @auth
            <!-- Vertical Line Separator -->
            <div class="h-10 border-l border-[#707070]"></div>

            <!-- User Profile Container -->
            <div class="group w-[130px] bg-transparent">
                <!-- User Profile Trigger -->
                <div class="flex items-center justify-between text-[#707070] hover:text-black dark:hover:text-white group-hover:text-black dark:group-hover:text-white transition-all duration-300 ease-in-out cursor-pointer">
                    {{ Auth::user()->name }} 
                    <svg class="inline w-4 h-4 ml-1" fill="currentColor" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-5 7-5-7h10"/>
                    </svg>
                </div>

                <!-- Profile Dropdown -->
                <div class="absolute hidden group-hover:flex flex-col w-[165px] top-14 right-11 p-4 pb-2 rounded-md bg-white dark:bg-gray-800 z-0">
                    <a href="{{ route('dashboard') }}" class="w-full py-2 text-[#707070] hover:text-black dark:hover:text-white transition-all duration-300 ease-in-out">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full py-2">
                        @csrf
                        <a onclick="event.preventDefault(); this.closest('form').submit();" href="{{ route('logout') }}" class="text-[#700000] hover:text-[#FF0000] transition-all duration-300 ease-in-out block">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
        @endauth
    </div>

    <!-- Hamburger Menu -->
    <div class="flex items-center lg:hidden">
        <button id="mobile-menu-button" class="p-2 text-[#707070] hover:text-black dark:hover:text-white outline-none transition-all duration-300 ease-in-out">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden absolute w-[165px] top-[65px] right-8 p-4 rounded-md bg-white dark:bg-gray-800">
        <div class="flex flex-col items-center">
            <a href="#" class="w-full py-2 text-[#707070] hover:text-black dark:hover:text-white transition-all duration-300 ease-in-out">Aktivitas</a>
            <a href="#" class="w-full py-2 text-[#707070] hover:text-black dark:hover:text-white transition-all duration-300 ease-in-out">Reservasi</a>
            <a href="#" class="w-full py-2 text-[#707070] hover:text-black dark:hover:text-white transition-all duration-300 ease-in-out">Tentang</a>
            @auth
                <hr class="my-2 border-[#707070] w-full">
                
                <!-- User Profile -->
                <a href="{{ route('dashboard') }}" class="w-full py-2 text-[#707070] hover:text-black dark:hover:text-white transition-all duration-300 ease-in-out">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" class="w-full py-2">
                    @csrf
                    <a onclick="event.preventDefault(); this.closest('form').submit();" href="route('logout')" class="text-[#700000] hover:text-[#FF0000] transition-all duration-300 ease-in-out">
                        {{ __('Log Out') }}
                    </a>
                </form>
            @endauth
        </div>
    </div>
</nav>

@if($transparent)
<script>
    // JavaScript for changing navbar background color on scroll
    document.addEventListener('DOMContentLoaded', function () {
        const nav = document.querySelector('nav.bg-transparent');
        if (!nav) return;
        
        const navHeight = nav.offsetHeight;

        window.addEventListener('scroll', function () {
            if (window.scrollY >= navHeight) {
                nav.classList.remove('bg-transparent');
                nav.classList.add('bg-white', 'dark:bg-gray-800', 'shadow-lg');
            } else {
                nav.classList.remove('bg-white', 'dark:bg-gray-800', 'shadow-lg');
                nav.classList.add('bg-transparent');
            }
        });
    });
</script>
@endif

<script>
    // JavaScript for mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.remove('hidden');
            mobileMenu.classList.add('block');
        } else {
            mobileMenu.classList.remove('block');
            mobileMenu.classList.add('hidden');
        }
    });
</script>