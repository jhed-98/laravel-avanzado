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
        'name' => 'Create',
    ],
]">
    <h1 class="text-2xl font-semibold mb-2">Nuevo Permisos</h1>
    <form action="{{ route('admin.permissions.store') }}" method="POST" class="bg-white rounded-lg p-6 shadow-lg">
        @csrf
        <div>

            <x-wireui:input class="mb-4" label="Nombre del permiso" placeholder="Ingrese el nombre del permiso"
                name="name" value="{{ old('name') }}" />

        </div>

        <div class="flex justify-end">
            <x-wireui:button type="submit" outline primary label="Crear permiso" />
        </div>
    </form>

</x-admin-layout>
