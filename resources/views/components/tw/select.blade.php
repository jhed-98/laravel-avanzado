@props([
    'key',
    'valueKey' => 'id',
    'option' => false,
    'label' => false,
    'for',
    'error' => false,
    'relation_key' => false,
    'collection' => false,
    'pluck' => false,
    'customLabel' => false,
    'class_father' => '',
])

@php
    // Obtener todos los atributos como un array
    $attributeKeys = array_keys($attributes->getAttributes());

    // Buscar cualquier atributo que empiece con "wire:model"
    $wireModelKey = collect($attributeKeys)->first(fn($key) => strpos($key, 'wire:model') === 0);

    // Obtener el valor de wire:model sin modificarlo
    $name = $wireModelKey ? $attributes->get($wireModelKey) : $name ?? '';
@endphp

<div with-validation-colors="true" @if ($errors->has($for)) group-invalidated="true" @endif
    class="aria-disabled:pointer-events-none aria-disabled:select-none aria-disabled:opacity-60 aria-readonly:pointer-events-none aria-readonly:select-none w-full relative {{ $class_father }}"
    form-wrapper="{{ $for }}">
    {{-- Label con color rojo si hay error --}}
    @if ($label)
        <div class="flex mb-1 justify-between items-end" name="form.wrapper.header">
            <label
                class="block text-sm font-medium disabled:opacity-60 text-gray-700 dark:text-gray-400 {{ $error ? 'invalidated:text-negative-600 dark:invalidated:text-negative-700' : '' }}"
                for="{{ $for }}">
                {{ $customLabel ?: $label }}
            </label>
        </div>
    @endif
    <label
        class="rounded-md focus-within:ring-primary-600 shadow bg-background-white dark:bg-background-dark relative flex justify-between gap-x-2 items-center transition-all ease-in-out duration-150 ring-1 ring-inset ring-gray-300 focus-within:ring-2 outline-0 pl-3 pr-3 py-2 invalidated:bg-negative-50 invalidated:ring-negative-500 invalidated:dark:ring-negative-700 invalidated:dark:bg-negative-700/10"
        for="{{ $for }}" name="form.wrapper.container">
        <select
            {{ $attributes->merge([
                'class' =>
                    'bg-transparent w-full p-0 !border-0 !outline-none !ring-0 sm:text-sm sm:leading-6 text-gray-900 dark:text-gray-400 placeholder:text-gray-400 dark:placeholder:text-gray-300 invalidated:text-negative-800 invalidated:dark:text-negative-600 invalidated:placeholder-negative-400 invalidated:dark:placeholder-negative-600/70',
                'name' => $name, // Aquí se asigna dinámicamente el name
            ]) }}
            id="{{ $for }}">
            @if ($option)
                <option disabled selected value="">{{ $option }}</option>
            @endif
            @if (is_array($key))
                @foreach ($key as $key => $element)
                    <option value="{{ $key }}">
                        {{ $element }}
                    </option>
                @endforeach
            @else
                @foreach ($key as $element)
                    <option
                        value="{{ is_numeric($element->$valueKey) ? intval($element->$valueKey) : $element->$valueKey }}"
                        @if (!$attributes->has('wire:model')) @if ($collection) @selected(collect(old($for, $pluck))->contains($element->$valueKey)) @else @selected(old($for, $pluck) == $element->$valueKey) @endif
                        @endif>
                        {{ $relation_key ? $element->$relation_key->name : $element->name }}
                    </option>
                @endforeach
            @endif
        </select>
    </label>
    @if ($error)
        <label class="text-sm text-negative-600 mt-2" for="{{ $for }}">
            {{ $error }}
        </label>
    @endif
</div>
