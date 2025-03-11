<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Laravel' }}</title>

    @stack('metas')

    <wireui:scripts />
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>

<body class="font-sans antialiased">

    @include('layouts.includes.admin.navbar')
    @include('layouts.includes.admin.aside')

    <main>
        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
                {{ $slot }}
            </div>
        </div>
    </main>

    @stack('modals')
    @livewireScripts
    @stack('scripts')

    @if (session('swal'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire(@json(session('swal')))
            });
        </script>
    @endif

</body>

</html>
