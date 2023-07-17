<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MyShop') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="">
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

@yield('links')

<body class="font-sans bg-[#61a5c2] antialiased dark:text-white">

<div class="min-h-screen dark:bg-gray-900 dark:text-white">

    <!-- Page Heading -->
    @auth
    @include('layouts.navigation')
    @include('layouts.sidebar')
@endauth
    {{--    Page Content--}}
    <main>
        {{ $slot }}
    </main>
</div>
@yield('scripts')

</body>

</html>
