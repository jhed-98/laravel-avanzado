{{-- LARAVEL 8+ --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Laravel' }}</title>

    @stack('metas')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @livewireStyles

</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    @include('layouts.includes.navbar')
    <main class="pt-20">
        {{ $slot }}
    </main>

    <wireui:scripts />
    @livewireScripts
    @stack('scripts')

</body>

</html>
