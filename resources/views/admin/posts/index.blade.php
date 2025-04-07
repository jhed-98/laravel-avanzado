<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Articulo',
    ],
]">

    <x-slot name="action_breadcrumbs">
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.posts.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">Nuevo</a>
        </div>
    </x-slot>
    <div>
        <ul class="space-y-8">
            @foreach ($posts as $post)
                <li class="grid grid-cols-1 lg:grid-cols-2 gap-4 border rounded-lg shadow-sm overflow-hidden">
                    <div>
                        <a href="{{ route('admin.posts.edit', $post) }}">
                            <img class="aspect-[16/9] object-cover object-center w-full" src="{{ $post->image }}">
                        </a>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('admin.posts.edit', $post) }}"
                            class="text-xl font-semibold">{{ $post->title }}</a>
                        <hr class="mt-1 mb-2">
                        <span @class([
                            'bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-sm dark:bg-blue-200 dark:text-blue-800 ms-3' =>
                                $post->published == \App\Enums\PostPublished::Publicado,
                            'bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-sm dark:bg-red-200 dark:text-red-800 ms-3' =>
                                $post->published == \App\Enums\PostPublished::Borrador,
                        ])>
                            {{ $post->published == \App\Enums\PostPublished::Publicado ? 'Publicado' : 'Borrador' }}</span>

                        <p class="my-3 text-base font-normal text-gray-700 dark:text-gray-400">
                            {{ Str::limit($post->excerpt, 100) }}</p>
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('admin.posts.edit', $post) }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Editar Articulo</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="mt-4">
        {{ $posts->links() }}
    </div>

</x-admin-layout>
