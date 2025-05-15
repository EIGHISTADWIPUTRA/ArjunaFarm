<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Arjuna Farm</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="/css/app.css">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/js/app.js" defer></script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @if(request()->routeIs('dashboard') ||
            request()->routeIs('packages.index') ||
            request()->routeIs('packages.create') ||
            request()->routeIs('packages.edit') ||
            request()->routeIs('packages.show') ||
            request()->routeIs('orders.index') ||
            request()->routeIs('orders.edit') ||
            request()->routeIs('orders.show') ||
            request()->routeIs('reservations.index') ||
            request()->routeIs('reservations.create') ||
            request()->routeIs('reservations.edit') ||
            request()->routeIs('reservations.show'))
            @include('layouts.dashboard-navigation')
        @else
            @include('layouts.navigation')
        @endif

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @hasSection('content')
                @yield('content')
            @else
                {{ $slot ?? '' }}
            @endif
        </main>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
