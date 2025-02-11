{{-- LARAVEL >= 8 --}}
<x-app-layout>

    @push('metas')
        <meta name="desciption" content="Hola" />
    @endpush

    <x-slot name="title">Post | LARAVEL >= 8</x-slot>

    <x-container width="4xl">
        <h3 class="text-red-500 text-2xl font-bold">
            Post List
        </h3>

        <ul>
            @foreach ($users as $user)
                <li>{{ $user->name . ' - ' . $user->email }}</li>
            @endforeach
        </ul>

        {{ $users->links() }}

        {{-- {{$users->links('components.pagination') }} --}}
    </x-container>

    <div class="container mx-auto px-4 md:px-6 py-4">
        {{-- Flowbite --}}
        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <span class="font-medium">Info alert!</span> Change a few things up and try submitting again.
        </div>
        {{-- WireUI --}}
        <x-alert title="Success Message!" positive solid />
    </div>

    <div class="container mx-auto px-4 md:px-6 py-4">
        <h3 class="text-red-500 text-2xl font-bold text-center md:text-left">
            Post List
        </h3>

        <ul>
            @foreach ($users as $user)
                <li>{{ $user->name . ' - ' . $user->email }}</li>
            @endforeach
        </ul>

        {{ $users->links() }}
    </div>
</x-app-layout>
