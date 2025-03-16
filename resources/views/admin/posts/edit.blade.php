<x-admin-layout>
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    <h1 class="text-2xl font-semibold mb-2">Nuevo artículo</h1>
    <div x-data>
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-lg p-6 shadow-lg" x-data="{ title: '', slug: '', imgPreview: '{{ $post->image }}' }" x-init="$watch('title', value => slug = string_to_slug(value))">
            @csrf
            @method('PUT')
            <div>
                <div class="mb-6 relative">
                    <figure>
                        <img x-show="imgPreview" :src="imgPreview"
                            class="aspect-[16/9] object-cover object-center w-full">
                    </figure>
                    <div class="absolute top-8 right-8">
                        <label class="bg-white px-4 py-2 rounded-lg border border-gray-500 shadow-sm cursor-pointer">
                            <i class="fa-solid fa-camera mr-2"></i>
                            Actualizar imagen
                            <input type="file" accept="image/*" class="hidden" name="image"
                                @change="file = $event.target.files[0]; imgPreview = URL.createObjectURL(file)">
                        </label>
                    </div>
                </div>
                <x-wireui:input class="mb-4" label="Título del artículo" placeholder="Escriba el nombre del artículo"
                    name="title" value="{{ old('title', $post->title) }}" x-model.fill="title" />

                <x-wireui:input class="mb-4" label="Slug" placeholder="Ingrese el slug del artículo" name="slug"
                    value="{{ old('slug', $post->slug) }}" x-model.fill="slug" readonly />

                {{-- <x-wireui:native-select class="mb-4 select-wrapper" label="Categoria" name="category_id">
                    <option selected disabled>Selecciona una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </x-wireui:native-select> --}}

                <x-tw.select class_father="mb-4 select-wrapper" label="Categoria" for="category_id" name="category_id"
                    :key="$categories" :pluck="$post->category_id" :error="$errors->first('category_id')" />

                <x-tw.select class_father="mb-4" class="tag-multiple" label="Etiquetas" for="tags" name="tags[]"
                    multiple="multiple" :key="$post->tags" :valueKey="'name'" :collection="true" :pluck="$post->tags->pluck('name')" />

                <x-wireui:textarea class="mb-4" label="Resumen" placeholder="Resumen del artículo"
                    name="excerpt">{{ old('excerpt', $post->excerpt) }}</x-wireui:textarea>

                <x-wireui:textarea class="mb-4" label="Cuerpo" placeholder="Cuerpo del artículo" rows="12"
                    name="body">{{ old('body', $post->body) }}</x-wireui:textarea>


                <div class="mb-4">
                    <div class="flex gap-4">
                        <x-tw.radio id="published-1" for="published" name="published" rounded="lg" label="Borrador"
                            value="{{ \App\Enums\PostPublished::Borrador->value }}" :field="\App\Enums\PostPublished::Borrador->value" :pluck="$post->published->value"
                            md :error="$errors->first('published')" />
                        <x-tw.radio id="published-2" for="published" name="published" rounded="lg" label="Publicado"
                            value="{{ \App\Enums\PostPublished::Publicado->value }}" :field="\App\Enums\PostPublished::Publicado->value"
                            :pluck="$post->published->value" md :error="$errors->first('published')" />
                    </div>
                    @if ($errors->first('published'))
                        <p class="mt-1 text-xs text-negative-500">{{ $errors->first('published') }}</p>
                    @endif
                </div>

                {{-- Or Custom WireUI --}}
                {{-- <div class="mb-4">
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
                </div> --}}
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
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.tag-multiple').select2({
                    width: '100%',
                    tags: true,
                    tokenSeparators: [',', ' '],
                    ajax: {
                        url: "{{ route('api.tags.index') }}",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                term: params.term
                            }
                        },
                        processResults: function(data) {
                            return {
                                results: data
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
</x-admin-layout>
