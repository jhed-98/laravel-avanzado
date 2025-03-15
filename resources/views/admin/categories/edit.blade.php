<x-admin-layout>
    <div x-data>
        <form action="{{ route('admin.categories.update', $category) }}" method="POST"
            class="bg-white rounded-lg p-6 shadow-lg" x-data="{ name: '', slug: '' }" x-init="$watch('name', value => slug = string_to_slug(value))">
            @csrf
            @method('PUT')
            <div>
                <x-wireui:input label="Nombre" placeholder="Escriba el nombre de la categorias" name="name"
                    class="mb-2" value="{{ old('name', $category->name) }}" x-model.fill="name" />
                <x-wireui:input label="Slug" placeholder="Slug de la categoria" name="slug" class="mb-2"
                    value="{{ old('slug', $category->slug) }}" x-model.fill="slug" readonly />
            </div>

            <div class="flex justify-end space-x-2">
                <x-wireui:button outline negative label="Eliminar" @click.prevent="$refs.deleteForm.submit()" />
                <x-wireui:button type="submit" outline primary label="Actualizar categoría" />
            </div>
        </form>
        <form x-ref="deleteForm" action="{{ route('admin.categories.destroy', $category) }}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
    @push('scripts')
        <script></script>
    @endpush
</x-admin-layout>
