<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
        'url' => route('admin.roles.index'),
    ],
    [
        'name' => $role->name,
    ],
]">
    {{-- <h1 class="text-2xl font-semibold mb-2">Nuevo artículo</h1> --}}
    <div x-data>
        <form action="{{ route('admin.roles.update', $role) }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-lg p-6 shadow-lg">
            @csrf
            @method('PUT')
            <div>

                <x-wireui:input class="mb-4" label="Nombre del rol" placeholder="Ingrese el nombre del rol" name="name"
                    value="{{ old('name', $role->name) }}" />

            </div>
            <div class="mb-4">
                <ul>
                    @foreach ($permissions as $permission)
                        <li>
                            <div class="flex items-center">
                                <input id="checked-{{ $permission->id }}" type="checkbox" value="{{ $permission->id }}"
                                    name="permissions[]" @checked(in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())))
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500  focus:ring-2">
                                <label for="checked-{{ $permission->id }}"
                                    class="ms-2 text-sm font-medium text-gray-900 ">
                                    {{ $permission->name }}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="flex justify-end space-x-2">
                <x-wireui:button outline negative label="Eliminar" @click.prevent="$refs.deleteForm.submit()" />
                <x-wireui:button type="submit" class="btnSendPost" outline primary label="Actualizar rol" />
            </div>
        </form>
        <form x-ref="deleteForm" action="{{ route('admin.roles.destroy', $role) }}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
</x-admin-layout>
