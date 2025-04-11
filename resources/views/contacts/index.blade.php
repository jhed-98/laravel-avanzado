<x-app-layout>
    <x-container class="py-12">

        <div class="bg-white p-8 rounded-lg shadow-lg">
            <form action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <x-wireui:input label="Nombre" name="name" placeholder="Ingrese nombre del contacto"
                        value="{{ old('name') }}" />
                </div>
                <div class="mb-4">
                    <x-wireui:input type="email" label="Correo" name="email"
                        placeholder="Ingrese correo del contacto" value="{{ old('email') }}" />
                </div>
                <div class="mb-4">
                    <x-wireui:textarea label="Mensaje" name="mensaje" rows="5"
                        placeholder="Ingrese el mensaje del contacto">{{ old('mensaje') }}</x-wireui:textarea>
                </div>
                <div class="mb-4">

                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload
                        file</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                        id="file_input" type="file" name="file">

                </div>
                <div class="flex justify-end">
                    <x-wireui:button type="submit" black label="Enviar" />
                </div>
            </form>
        </div>

    </x-container>
</x-app-layout>
