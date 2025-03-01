<x-app-layout>

    <x-container class="container py-4">
        <div class="pb-4">
            <a href="{{ route('posts.edit', $post) }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Editar post
            </a>
        </div>

        <h1>Post Show: {{ $post->title }}</h1>
        <p>Category: {{ $post->category->name }}</p>
        <div>
            {{ $post->content }}
        </div>

        <div class="py-4">
            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                @csrf
                @method('DELETE')
                <x-button type="submit" outline negative label="Eliminar" />
            </form>
        </div>
    </x-container>

</x-app-layout>
