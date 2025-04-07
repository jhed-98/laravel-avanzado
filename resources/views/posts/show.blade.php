<x-app-layout>

    <x-container class="container py-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            <section class="col-span-1 lg:col-span-3">

                <ul class="flex space-x-2 mb-2">
                    @foreach ($post->tags as $tag)
                        <span
                            class="outline-none inline-flex justify-center items-center group rounded gap-x-1 text-xs font-semibold px-2.5 py-0.5 text-primary-600 bg-primary-100 dark:bg-slate-700">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </ul>

                <h1 class="text-4xl font-semibold">
                    Cómo Convertir un Texto en un Slug con JavaScript
                </h1>

                <hr class="mt-1 mb-2">

                <div class="flex items-center mb-6">
                    <figure class="mr-4">
                        <img class="size-8 rounded-full object-cover" src="{{ $post->user->profile_photo_url }}"
                            alt="{{ $post->user->name }}" />
                    </figure>

                    <div>
                        <p class="font-semibold">{{ $post->user->name }}</p>
                        <p class="text-sm">{{ $post->publishedtime }}</p>
                    </div>
                </div>

                <figure class="mb-8">
                    <img class="aspect-[16/9] w-full object-cover object-center" src="{{ $post->image }}"
                        alt="{{ $post->title }}">
                </figure>

                <div class="quill-editor-content">
                    {!! $post->body !!}
                </div>

            </section>
        </div>
    </x-container>

</x-app-layout>
