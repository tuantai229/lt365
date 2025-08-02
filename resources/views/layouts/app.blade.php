<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <x-seo-tags :seoData="$seoData ?? []" />

    
    <link rel="stylesheet" href="{{ asset('fonts/font.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" integrity="sha384-gZdi/GePRim8dwNmamYC6d8U/rDkyvPpTT7g1PoWC8gU6yj8PeJtGP/N9wdD3cG/" crossorigin="anonymous" onerror="this.onerror=null;this.href='{{ asset('js/fallbacks/remixicon.css') }}'">
    
    <!-- Alpine.js for interactive components -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" integrity="sha384-9Ax3MmS9AClxJyd5/zafcXXjxmwFhZCdsT6HJoJjarvCaAkJlk5QDzjLJm+Wdx5F" crossorigin="anonymous" onerror="this.onerror=null;this.src='{{ asset('js/fallbacks/alpine.js') }}'"></script>

    <style>
        {!! file_get_contents(public_path('css/critical.css')) !!}
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-50">

    @include('layouts.partials.header')
    @include('layouts.partials.navigation')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <!-- Favorites functionality -->
    <script>
        window.isUserLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
    </script>
    <script src="{{ asset('js/favorites.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
