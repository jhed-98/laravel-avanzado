<x-admin-layout>
    {{-- <h1 class="text-2xl font-semibold mb-2">Nuevo artículo</h1> --}}
    <div x-data>
        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-lg p-6 shadow-lg">
            @csrf
            @method('PUT')
            <div>

                <x-wireui:input class="mb-4" label="Nombre" name="name" value="{{ old('name', $user->name) }}" />
                <x-wireui:input class="mb-4" label="Email" name="email" value="{{ old('email', $user->email) }}"
                    type="email" />
                <x-wireui:input class="mb-4" label="Password" name="password" type="password" />
                <x-wireui:input class="mb-4" label="Confirmar Password" name="password_confirmation"
                    type="password" />

            </div>
            <div class="mb-4">
                <p class="text-lg fw-bold">Seleccione el rol para el usuario</p>
                <ul>
                    @foreach ($roles as $role)
                        <li>
                            <div class="flex items-center">
                                <input id="checked-{{ $role->id }}" type="checkbox" value="{{ $role->id }}"
                                    name="roles[]" @checked(in_array($role->id, old('roles', $user->roles->pluck('id')->toArray())))
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                                <label for="checked-{{ $role->id }}"
                                    class="ms-2 text-sm font-medium text-gray-900 ">
                                    {{ $role->name }}</label>
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
        <form x-ref="deleteForm" action="{{ route('admin.users.destroy', $role) }}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
</x-admin-layout>
