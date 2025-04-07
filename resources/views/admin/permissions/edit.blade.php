<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Permisos',
        'url' => route('admin.permissions.index'),
    ],
    [
        'name' => $permission->name,
    ],
]">
    {{-- <h1 class="text-2xl font-semibold mb-2">Nuevo artículo</h1> --}}
    <div x-data>
        <form action="{{ route('admin.permissions.update', $permission) }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-lg p-6 shadow-lg">
            @csrf
            @method('PUT')
            <div>
                <x-wireui:input class="mb-4" label="Nombre del permiso" placeholder="Ingrese el nombre del permiso"
                    name="name" value="{{ old('name', $permission->name) }}" />

            </div>

            <div class="flex justify-end space-x-2">
                <x-wireui:button outline negative label="Eliminar" @click.prevent="$refs.deleteForm.submit()" />
                <x-wireui:button type="submit" class="btnSendPost" outline primary label="Actualizar permiso" />
            </div>
        </form>
        <form x-ref="deleteForm" action="{{ route('admin.permissions.destroy', $permission) }}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
</x-admin-layout>
