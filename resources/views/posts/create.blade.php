<x-app-layout>

    <x-container class="container py-4">

        <form action="{{ route('posts.store') }}" method="POST" class="max-w-md mx-auto">
            @csrf
            <x-input label="Titulo de posts" name="title" class="pb-4" />
            <x-textarea label="Description de posts" name="content" class="pb-4" />
            <!-- prettier-ignore -->
            <x-select
            class="pb-4"
            label="Categories"
            placeholder="Select one category"
            :options="$categories"
            option-value="id"
            option-label="name"
            name="category_id"
            />
            <!-- prettier-ignore -->
            <x-button
            type="submit"
            outline
            primary
            label="Crear post" />
        </form>

    </x-container>

</x-app-layout>
