<x-admin-layout>
    <form action="{{ route('admin.categories.store') }}" method="POST" class="bg-white rounded-lg p-6 shadow-lg"
        x-data="{ name: '', slug: '' }" x-init="$watch('name', value => slug = string_to_slug(value))">
        @csrf
        <div>
            <x-wireui:input label="Nombre" placeholder="Escriba el nombre de la categorias" name="name" class="mb-2"
                x-model.fill="name" />
            <x-wireui:input label="Slug" placeholder="Slug de la categoria" name="slug" class="mb-2"
                x-model.fill="slug" readonly />
        </div>

        <div class="flex justify-end">
            <x-wireui:button type="submit" outline primary label="Crear categoría" />
        </div>
    </form>
</x-admin-layout>
