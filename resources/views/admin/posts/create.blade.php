<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Artículos',
        'url' => route('admin.posts.index'),
    ],
    [
        'name' => 'Create',
    ],
]">
    <h1 class="text-2xl font-semibold mb-2">Nuevo artículo</h1>
    <form action="{{ route('admin.posts.store') }}" method="POST" class="bg-white rounded-lg p-6 shadow-lg"
        x-data="{ title: '', slug: '' }" x-init="$watch('title', value => slug = string_to_slug(value))">
        @csrf
        <div>

            <x-wireui:input class="mb-4" label="Título del artículo" placeholder="Escriba el nombre del artículo"
                name="title" value="{{ old('title') }}" x-model.fill="title" />

            <x-wireui:input class="mb-4" label="Slug" placeholder="Ingrese el slug del artículo" name="slug"
                value="{{ old('slug') }}" x-model.fill="slug" readonly />

            {{-- <x-wireui:native-select class="mb-4 select-wrapper" label="Categoria" name="category_id">
                <option selected disabled>Selecciona una categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </x-wireui:native-select> --}}

            <x-tw.select class_father="mb-4 select-wrapper" label="Categoria" for="category_id" name="category_id"
                :key="$categories" option="Selecciona una categoria" :error="$errors->first('category_id')" />

        </div>

        <div class="flex justify-end">
            <x-wireui:button type="submit" outline primary label="Crear artículo" />
        </div>
    </form>

</x-admin-layout>
