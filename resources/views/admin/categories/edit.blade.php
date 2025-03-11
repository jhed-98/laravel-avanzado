<x-admin-layout>
    <div x-data>
        <form action="{{ route('admin.categories.update', $category) }}" method="POST"
            class="bg-white rounded-lg p-6 shadow-lg">
            @csrf
            @method('PUT')
            <div x-data="{ name: @js($category->name), slug: @js($category->slug) }">
                <x-wireui:input label="Nombre" placeholder="Escriba el nombre de la categorias" name="name"
                    class="mb-2" x-model="name" x-on:input="string_to_slug($event.target.value, '#slug')" />
                <x-wireui:input label="Slug" placeholder="Slug de la categoria" name="slug" class="mb-2"
                    x-model="slug" readonly />
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
