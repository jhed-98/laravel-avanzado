{{-- LARAVEL >= 8 --}}
<x-app-layout>

    @push('metas')
        <meta name="desciption" content="Hola" />
    @endpush

    <x-slot name="title">Post</x-slot>

    <x-container class="container py-4">

        <div class="pb-4">
            <a href="{{ route('posts.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Crear post
            </a>
        </div>

        <h3 class="text-red-500 text-2xl font-bold text-center md:text-left">
            Post List
        </h3>

        <ul>
            @foreach ($posts as $post)
                <li><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></li>
            @endforeach
        </ul>

        {{ $posts->links() }}
        {{-- {{$posts->links('components.pagination') }} --}}
    </x-container>

</x-app-layout>
