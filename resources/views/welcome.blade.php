<x-app-layout>
    <x-container class="mt-10">
        {{-- <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            @foreach ($posts as $post)
                <x-tw.card-product :post="$post" />
            @endforeach
        </div> --}}

        <div>
            <section>
                <x-container>
                    <div>
                        <h1 class="text-3xl text-center font-semibold mb-6">Lista articulo</h1>
                    </div>
                    <div x-data="{ open: false }" class ="md:flex gap-6">
                        <aside :class="open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" x-cloak
                            class="fixed z-40 top-0 left-0 h-full bg-white w-80 border-r p-4 transition-transform duration-300 ease-in-out lg:sticky lg:top-5 lg:translate-x-0">
                            <div class="flex justify-between items-center lg:hidden mb-4">
                                <h2 class="text-lg font-semibold">Filtros</h2>
                                <button @click="open = false" class="text-gray-600 hover:text-black">&times;</button>
                            </div>

                            <div>
                                <div>
                                    <form action="{{ route('home') }}">
                                        <div class="mb-4">
                                            <label for="order"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ordenar:</label>
                                            <select id="order" name="order"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option value="new">Más nuevos</option>
                                                <option value="old" @selected('order' == 'old')>Más antiguos
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="order"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categorías:</label>

                                            @foreach ($categories as $category)
                                                <div class="flex items-center">
                                                    <input id="checkbox-category-{{ $category->id }}" type="checkbox"
                                                        name="category[]" value="{{ $category->id }}"
                                                        @checked(is_array(request('category')) && in_array($category->id, request('category')))
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 ">
                                                    <label for="checkbox-category-{{ $category->id }}"
                                                        class="ms-2 text-sm font-medium text-gray-900">{{ $category->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="mb-4 text-center">
                                            <x-wireui:button type="submit" black label="Aplicar filtros" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </aside>
                        <div class="w-full">
                            <!-- Botón abrir filtros (solo en móvil) -->
                            <div class="lg:hidden mb-4">
                                <button @click="open = true" class="px-4 py-2 bg-blue-600 text-white rounded">
                                    Abrir Filtros
                                </button>
                            </div>
                            <div class="grid grid-cols-1 gap-4">
                                @foreach ($posts as $post)
                                    <div class="border border-gray-200 grid grid-cols-1 md:grid-cols-2">
                                        <a href="#">
                                            <img class="rounded-t-lg aspect-[16/9]" src="{{ $post->image }}"
                                                alt="{{ $post->title }}" />
                                        </a>
                                        <div class="p-5">
                                            <a href="#">
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                                    {{ $post->title }}
                                                </h5>
                                            </a>
                                            <hr class="mb-2">
                                            <div class="mb-2">
                                                @foreach ($post->tags as $tag)
                                                    <a href="{{ route('home') . '?tag=' . $tag->name }}">
                                                        <span
                                                            class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">{{ $tag->name }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                            <p class="mb-3 font-normal text-gray-700">
                                                {{ Str::limit($post->excerpt, 100, '...') }}
                                            </p>
                                            <p class="text-xs mb-2">{{ $post->publishedtime }}</p>
                                            <a href="{{ route('posts.show', $post) }}"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                Leer más
                                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </x-container>
            </section>
        </div>

        {{-- <div>
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
                                <a href="{{ route('posts.show', $post) }}"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Leer articulo</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div> --}}
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </x-container>
</x-app-layout>
