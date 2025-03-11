<x-admin-layout>
    <form action="{{ route('admin.categories.store') }}" method="POST" class="bg-white rounded-lg p-6 shadow-lg">
        @csrf
        <div x-data="{ name: '', slug: '' }">
            <x-wireui:input label="Nombre" placeholder="Escriba el nombre de la categorias" name="name" class="mb-2"
                x-on:input="string_to_slug($event.target.value, '#slug')" />
            <x-wireui:input label="Slug" placeholder="Slug de la categoria" name="slug" class="mb-2" readonly />
        </div>

        <div class="flex justify-end">
            <x-wireui:button type="submit" outline primary label="Crear categoría" />
        </div>
    </form>
</x-admin-layout>
