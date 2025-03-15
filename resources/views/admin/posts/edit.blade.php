<x-admin-layout>
    <h1 class="text-2xl font-semibold mb-2">Nuevo artículo</h1>
    <div x-data>
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="bg-white rounded-lg p-6 shadow-lg"
            x-data="{ title: '', slug: '' }" x-init="$watch('title', value => slug = string_to_slug(value))">
            @csrf
            @method('PUT')
            <div>

                <x-wireui:input class="mb-4" label="Título del artículo" placeholder="Escriba el nombre del artículo"
                    name="title" value="{{ old('title', $post->title) }}" x-model.fill="title" />

                <x-wireui:input class="mb-4" label="Slug" placeholder="Ingrese el slug del artículo" name="slug"
                    value="{{ old('slug', $post->slug) }}" x-model.fill="slug" readonly />

                <x-wireui:native-select class="mb-4 select-wrapper" label="Categoria" name="category_id">
                    <option selected disabled>Selecciona una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </x-wireui:native-select>

                <x-wireui:textarea class="mb-4" label="Resumen" placeholder="Resumen del artículo"
                    name="excerpt">{{ old('excerpt', $post->excerpt) }}</x-wireui:textarea>

                <x-wireui:textarea class="mb-4" label="Cuerpo" placeholder="Cuerpo del artículo" rows="12"
                    name="body">{{ old('body', $post->body) }}</x-wireui:textarea>

                {{-- Or Custom --}}
                <div class="mb-4">
                    <div class="flex gap-4">
                        <x-tw.radio id="published_1" name="published"
                            value="{{ \App\Enums\PostPublished::Borrador->value }}" label="Borrador"
                            checked="{{ old('published', $post->published->value) == \App\Enums\PostPublished::Borrador->value }}" />

                        <x-tw.radio id="published_2" name="published"
                            value="{{ \App\Enums\PostPublished::Publicado->value }}" label="Publicado"
                            checked="{{ old('published', $post->published->value) == \App\Enums\PostPublished::Publicado->value }}" />
                    </div>

                    @if ($errors->first('published'))
                        <p class="mt-1 text-xs text-negative-500">{{ $errors->first('published') }}</p>
                    @endif
                </div>
            </div>

            <div class="flex justify-end space-x-2">
                <x-wireui:button outline negative label="Eliminar" @click.prevent="$refs.deleteForm.submit()" />
                <x-wireui:button type="submit" outline primary label="Actualizar articulo" />
            </div>
        </form>
        <form x-ref="deleteForm" action="{{ route('admin.posts.destroy', $post) }}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>

</x-admin-layout>
