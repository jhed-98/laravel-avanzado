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

                {{-- <x-wireui:textarea class="mb-4" label="Cuerpo" placeholder="Cuerpo del artículo" rows="12"
                    name="body">{{ old('body', $post->body) }}</x-wireui:textarea> --}}


                {{-- <div x-data x-init="ClassicEditor.create($refs.editor)
                    .then(editor => {})
                    .catch(error => {
                        console.error('There was a problem initializing the editor.', error);
                    });" class="mb-4 ckeditor">
                    <x-wireui:textarea class="mb-4" label="Cuerpo" placeholder="Cuerpo del artículo" rows="12"
                        x-ref="editor" name="body">{{ old('body', $post->body) }}</x-wireui:textarea>
                </div> --}}

                {{-- <div class="mb-4 ckeditor">
                    <x-wireui:textarea class="mb-4" label="Cuerpo" placeholder="Cuerpo del artículo" rows="12"
                        id="editor-ckeditor" name="body">{{ old('body', $post->body) }}</x-wireui:textarea>
                </div> --}}

                <div class="pb-4">
                    <div id="editor-quill">{!! old('body', $post->body) !!}</div>
                </div>

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
                <input type="hidden" name="body">
                <x-wireui:button outline negative label="Eliminar" @click.prevent="$refs.deleteForm.submit()" />
                <x-wireui:button type="submit" class="btnSendPost" outline primary label="Actualizar articulo" />
            </div>
        </form>
        <form x-ref="deleteForm" action="{{ route('admin.posts.destroy', $post) }}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>

    <!-- Modal -->
    <div id="embed-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl">
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-center p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-title">Insert HTML</h3>
                    <button type="button"
                        class="close-embed-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4">
                    <textarea id="htmlcode" rows="14"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Inserte código HTML para ser agregado al post"></textarea>
                    <p class="text-xs text-gray-400 pt-3">Para generar tablas podemos usar <a
                            href="https://www.tablesgenerator.com/html_tables" target="_blank" class="text-indigo-800">
                            Tables Generator</a></p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button"
                        class="btn-quill-body w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Insertar
                    </button>
                </div>
            </div>
        </div>
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
        {{-- CKEDITOR --}}
        {{-- <script>
            document.addEventListener("DOMContentLoaded", function() {
                ClassicEditor
                    .create(document.querySelector('#editor-ckeditor'), {
                        simpleUpload: {
                            // The URL that the images are uploaded to.
                            uploadUrl: "{{ route('api.images.upload') }}",

                            // Enable the XMLHttpRequest.withCredentials property.
                            withCredentials: true,

                            // Headers sent along with the XMLHttpRequest to the upload server.
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                // Authorization: 'Bearer <JSON Web Token>'
                            }
                        }
                    })
                    .then()
                    .catch( /* ... */ );
            })
        </script> --}}
        {{-- QUILL JS --}}
        <script>
            var quill, range, $embeded;

            document.addEventListener("DOMContentLoaded", function() {
                // 🔹 Obtener referencias a los elementos del DOM
                const modalEl = document.getElementById("embed-modal");
                const modalHtmlQuill = new Modal(modalEl, {
                    backdrop: "static",
                    closable: false
                });

                const htmlCodeTextarea = document.getElementById("htmlcode");
                // const editHtmlCodeTextarea = modalUpdateEl.querySelector("textarea");
                const quillEditor = document.getElementById("editor-quill");

                // 🔹 Definir una nueva clase de Blot para Quill
                const BlockEmbed = Quill.import('blots/block/embed');
                class AppPanelEmbed extends BlockEmbed {
                    static create(value) {
                        const node = super.create(value);
                        node.setAttribute("contenteditable", "false");
                        node.setAttribute("width", "100%");
                        node.innerHTML = this.transformValue(value);
                        return node;
                    }

                    static transformValue(value) {
                        return value.split("\n").map(e => e.trim()).join("");
                    }

                    static value(node) {
                        return node.innerHTML;
                    }
                }

                AppPanelEmbed.blotName = "customEmbed";
                AppPanelEmbed.className = "ql-embed-content";
                AppPanelEmbed.tagName = "div";
                Quill.register(AppPanelEmbed, true);

                // 🔹 Inicializar Quill
                quill = new Quill("#editor-quill", {
                    theme: "snow",
                    modules: {
                        syntax: {
                            hljs: window.hljs
                        },
                        toolbar: [
                            [{
                                font: []
                            }],
                            [{
                                header: [1, 2, 3, 4, 5, 6, false]
                            }],
                            ["bold", "italic", "underline", "strike"],
                            [{
                                list: "ordered"
                            }, {
                                list: "bullet"
                            }],
                            [{
                                script: "sub"
                            }, {
                                script: "super"
                            }],
                            [{
                                indent: "-1"
                            }, {
                                indent: "+1"
                            }],
                            [{
                                align: []
                            }],
                            ["blockquote", "code-block"],
                            ["link", "image", "video"],
                            ["clean"],
                        ],
                    },
                });

                // 🔹 Agregar botón "HTML" a la barra de herramientas de Quill
                document.querySelector(".ql-toolbar").insertAdjacentHTML(
                    "beforeend",
                    `<span class="ql-formats">
                        <button type="button" class="ql-htmlcode text-gray-900 hover:!text-gray-500 focus:!text-gray-500 text-sm">HTML</button>
                    </span>`
                );

                // 🔹 Eventos
                document.querySelector(".ql-htmlcode").addEventListener("click", () => {
                    htmlCodeTextarea.value = "";
                    range = quill.getSelection() || {
                        index: 0,
                        length: 0
                    };
                    modalHtmlQuill.show();
                    document.querySelector('#embed-modal .text-title').innerHTML = "Insertar HTML"
                    document.querySelector(".btn-quill-body").innerHTML = "Insertar"
                });

                document.querySelector(".btn-quill-body").addEventListener("click", () => {
                    const html = htmlCodeTextarea.value.trim();
                    if (html) {
                        if ($embeded) {
                            // Editar embed existente
                            $embeded.html(html);
                        } else {
                            // Insertar nuevo embed
                            quill.insertEmbed(range.index, "customEmbed", html);
                        }
                        modalHtmlQuill.hide();
                        htmlCodeTextarea.value = "";
                    }
                });

                document.querySelector(".close-embed-modal").addEventListener("click", () => modalHtmlQuill.hide());

                quillEditor.addEventListener("click", (event) => {
                    const target = event.target.closest(".ql-embed-content");
                    if (target) {
                        $embeded = $(target); // Establecer referencia al embed
                        htmlCodeTextarea.value = $embeded.html(); // Cargar el HTML en el textarea
                        modalHtmlQuill.show();
                        document.querySelector('#embed-modal .text-title').innerHTML = "Editar HTML"
                        document.querySelector(".btn-quill-body").innerHTML = "Actualizar"
                    }
                });

                document.querySelector(".btnSendPost").addEventListener("click", (e) => {
                    // Obtener el contenido del editor Quill
                    // var content = quill.root.innerHTML;

                    // Clonar el contenido del editor sin modificar el original
                    let editorClone = document.querySelector(".ql-editor").cloneNode(true);
                    editorClone.querySelectorAll(".ql-code-block-container select.ql-ui").forEach(el => el
                        .remove());
                    let content = editorClone.innerHTML;

                    document.querySelector('[name=body]').value = content;
                })
                quill.getModule("toolbar").addHandler("image", () => {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.click();

                    input.onchange = function() {
                        var file = input.files[0];
                        if (file) {
                            var formData = new FormData();
                            formData.append('upload', file);

                            // Agregar CSRF Token
                            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                            // Subir la imagen con AJAX
                            $.ajax({
                                url: "{{ route('api.images.upload') }}",
                                type: "POST",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    if (response.url) {
                                        range = quill.getSelection();
                                        quill.insertEmbed(range.index, 'image', response.url);
                                    } else {
                                        console.error('Error al subir la imagen');
                                    }
                                },
                                error: function(error) {
                                    console.error('Error:', error);
                                }
                            });
                        }
                    };
                })
            });
        </script>
    @endpush
</x-admin-layout>
