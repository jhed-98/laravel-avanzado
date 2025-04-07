<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm">
    <a href="#">
        <img class="rounded-t-lg" src="{{ $post->image }}" alt="{{ $post->title }}" />
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
                <span
                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">{{ $tag->name }}</span>
            @endforeach
        </div>
        <p class="mb-3 font-normal text-gray-700">
            {{ Str::limit($post->excerpt, 100, '...') }}
        </p>
        <p class="text-xs mb-2">{{ $post->publishedtime }}</p>
        <a href="{{ route('posts.show', $post) }}"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            Leer más
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </a>
    </div>
</div>
