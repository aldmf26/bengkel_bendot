<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    <style>
        * {
            font-family: 'Poppins', sans-serif;
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
        class="absolute bottom-[-100px] left-[-100px] w-[400px] h-[400px] bg-gradient-to-br from-[#43CAFF] to-[#85D8FF] rounded-full opacity-20">
    </div>

    <nav style="margin: 20px 80px" class="flex justify-between my-px">
        <div>
            <h1 class="text-xl font-bold text-primary">BengDot</h1>
        </div>

        <a href="{{ route('login') }}"
        class="flex items-center justify-center w-40 h-12 px-4 py-2 bg-primary rounded-lg text-white font-semibold text-sm">

        Login
    </a>
    </nav>

    <div class="absolute top-80 right-80 z-10">
        <img width="66" height="66"
            src="https://img.icons8.com/external-smashingstocks-flat-smashing-stocks/66/external-motorbike-transport-smashingstocks-flat-smashing-stocks.png"
            alt="external-motorbike-transport-smashingstocks-flat-smashing-stocks" />
    </div>
    <div class="absolute top-50 left-72 z-10">
        <img width="50" height="50"
            src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/50/external-hand-tools-tools-and-materials-ecommerce-flaticons-lineal-color-flat-icons.png"
            alt="external-hand-tools-tools-and-materials-ecommerce-flaticons-lineal-color-flat-icons" />
    </div>

    <div class="flex justify-center items-center min-h-[20vh]">
        <div class="text-center">
            <h2 class="text-5xl font-bold mb-4">
                Bengkel <span class="text-primary">Bendot</span>
                {{-- <span class="block mt-4">Booking Sekarang</span> --}}
            </h2>
            <p class="text-sm text-primary">Servis Motor. Teknisi Bersertifikasi. Diagnostic Tool Terlengkap
                Tercanggih Dan Bergaransi</p>
        </div>
    </div>
    <div class="flex justify-center">
        <img class="w-[400px] shadow-xl border-8 border-black rounded-3xl" src="{{ asset('assets/img/maskot.png') }}"
            alt="">
    </div>

</body>

</html>
