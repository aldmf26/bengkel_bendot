<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Vendors -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- Styles and Script -->
    @vite(['resources/css/app.css', 'resources/sass/bootstrap.scss', 'resources/sass/themes/dark/app-dark.scss', 'resources/sass/app.scss', 'resources/sass/pages/auth.scss', 'resources/js/app.js'])

</head>

<body>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <img class="mx-auto h-10 w-auto" width="50" height="50"
            src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/50/external-hand-tools-tools-and-materials-ecommerce-flaticons-lineal-color-flat-icons.png"
            alt="external-hand-tools-tools-and-materials-ecommerce-flaticons-lineal-color-flat-icons" />
          <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        </div>
      
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
          {{$slot}}
      
          <p class="mt-10 text-center text-sm/6 text-gray-500">
            Daftar ?
            <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Register</a>
          </p>
        </div>
      </div>
</body>

</html>
