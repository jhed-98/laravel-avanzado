<x-app-layout>

    <x-container class="container py-4">

        <form action="{{ route('posts.update', $post) }}" method="POST" class="max-w-md mx-auto">
            @csrf
            @method('PATCH')
            <x-input label="Titulo de posts" name="title" class="pb-4" value="{{ old('title', $post->title) }}" />
            <x-input label="Slug de posts" name="slug" class="pb-4" value="{{ old('slug', $post->slug) }}" />
            <x-textarea label="Description de posts" name="content"
                class="pb-4">{{ old('content', $post->content) }}</x-textarea>
            <x-native-select label="Select Status" name="category_id" class="pb-4">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </x-native-select>
            {{-- <x-select class="pb-4" label="Categories" placeholder="Select one category" :options="$categories"
                option-value="id" option-label="name" name="category_id" :selected="old('category_id', $post->category_id) == $category->id" /> --}}
            <!-- prettier-ignore -->
            <x-button
            type="submit"
            outline
            primary
            label="Actualizar post" />
        </form>

    </x-container>

</x-app-layout>
