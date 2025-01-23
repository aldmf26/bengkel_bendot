<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>

        </style>
    @endif

</head>

<body class="bg-[#F0F1EC]">
    <div
        class="absolute top-[-100px] right-[100px] w-[300px] h-[300px] bg-gradient-to-br from-[#FFCA43] to-[#FFD85F] rounded-full opacity-20">
    </div>
    <div
        class="absolute bottom-[-100px] left-[-100px] w-[400px] h-[400px] bg-gradient-to-br from-[#43CAFF] to-[#85D8FF] rounded-full opacity-20">
    </div>

    <nav style="margin: 20px 80px" class="flex justify-between my-px">
        <div>
            <h1 class="text-xl font-bold text-primary">AgrikaPOS</h1>
        </div>
        <div class="flex gap-x-10 text-md font-semibold text-primary">
            @php
                $li = collect(['Home', 'Features', 'Contact']);
            @endphp
            @foreach ($li as $d)
                <a class="hover:underline decoration-2 decoration-primary transition duration-200 ease-in-out {{ $d == 'Home' ? 'font-bold underline' : '' }}"
                    href="/{{ $d == 'Home' ? '' : strtolower($d) }}">{{ $d }}</a>
            @endforeach
        </div>
        <div>
            <button class="bg-btnBg p-2 rounded-lg text-md font-semibold">Try For Free</button>
        </div>
    </nav>

    <div class="absolute top-80 right-80 z-10">
        <img class="bg-green-400 rounded-2xl p-1"
            src="https://img.icons8.com/?size=50&id=zMUCq0NlkGay&format=png&color=000000" alt="">
    </div>
    <div class="absolute top-50 left-72 z-10">
        <img class="bg-green-400 rounded-2xl p-1"
            src="https://img.icons8.com/?size=50&id=8k1b1o4i7J5Y&format=png&color=000000" alt="">
    </div>

    <div class="flex justify-center items-center min-h-[40vh]">
        <div class="text-center">
            <h2 class="text-5xl font-bold mb-4">
                Optimize Your <span class="text-primary">Business</span>
                <span class="block mt-4">With Simple & Easy POS</span>
            </h2>
            <p class="text-sm text-primary mb-6">We handle everything from POS to payroll. So you can focus on what you
                love</p>
            <div class="flex gap-3 justify-center">
                <a href="/register" class="bg-btnBg p-2 rounded-lg text-md font-semibold">Get Started</a>
                <button class="bg-slate-200 p-2 rounded-lg text-md font-semibold">▶️ Watch Video</button>
            </div>

        </div>
    </div>
    <div class="flex justify-center">
        <img class="shadow-xl border-8 border-black rounded-3xl" src="{{ asset('assets/img/hero.png') }}"
            alt="">
    </div>

</body>

</html>
