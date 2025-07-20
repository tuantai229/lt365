<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LT365 - Đồng hành cùng con vào trường chuyên')</title>

    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#4f46e5',secondary:'#f59e0b'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :where([class^="ri-"])::before { content: "\f3c2"; }
        body {
            font-family: 'Roboto', sans-serif;
        }
        .hero-slider::-webkit-scrollbar {
            display: none;
        }
        .dropdown {
            display: none;
        }
        .dropdown-trigger:hover .dropdown {
            display: block;
        }
        .nested-dropdown {
            display: none;
        }
        .nested-dropdown-trigger:hover .nested-dropdown {
            display: block;
        }
        .custom-checkbox {
            position: relative;
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #4f46e5;
            border-radius: 4px;
            cursor: pointer;
        }
        .custom-checkbox::after {
            content: "";
            position: absolute;
            display: none;
            left: 6px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .custom-checkbox.checked {
            background-color: #4f46e5;
        }
        .custom-checkbox.checked::after {
            display: block;
        }
        input[type="search"]::-webkit-search-decoration,
        input[type="search"]::-webkit-search-cancel-button,
        input[type="search"]::-webkit-search-results-button,
        input[type="search"]::-webkit-search-results-decoration {
            display: none;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        /* Hero Slider Styles */
        .hero-slide {
            opacity: 0;
            transform: translateX(100px);
            transition: all 0.6s ease-in-out;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .hero-slide.active {
            opacity: 1;
            transform: translateX(0);
        }
        .hero-slide.prev {
            transform: translateX(-100px);
            opacity: 0;
        }
        .slide-indicator {
            transition: all 0.3s ease;
        }
        .slide-indicator.active {
            opacity: 1;
            background-color: white;
        }
        /* Navigation Arrows - ẩn mặc định */
        .slider-nav-btn {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        /* Hiện nút khi hover vào slider container */
        .hero-slider-container:hover .slider-nav-btn {
            opacity: 1;
            visibility: visible;
        }

        .content-slider {
            scroll-behavior: smooth;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE/Edge */
        }

        .content-slider::-webkit-scrollbar {
            display: none; /* Chrome/Safari */
        }

        .content-slider-wrapper {
            position: relative;
        }

        .nav-btn {
            transition: opacity 0.3s ease;
        }

        .nav-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }
        @media (max-width: 768px) {
            .content-slider {
                gap: 1rem;
            }
            
            .content-slider .min-w-[280px] {
                min-width: 250px;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50">

    @include('layouts.partials.header')
    @include('layouts.partials.navigation')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @stack('scripts')
</body>
</html>
