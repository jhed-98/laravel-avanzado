{{-- LARAVEL >= 8 --}}
<x-app-layout>

    @push('metas')
        <meta name="desciption" content="Hola" />
    @endpush

    <x-slot name="title">Post | LARAVEL >= 8</x-slot>

    <x-container width="4xl">
        <h3>
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

</x-app-layout>
