@props([
    'id' => '',
    'for' => '',
    'label' => '',
    'error' => false,
    'field' => '',
    'pluck' => false,
    'class_father' => '',
    'rounded' => 'base',
    'xs' => false,
    'sm' => false,
    'md' => false,
    'lg' => false,
    'xl' => false,
])
@php

    $sizes = [
        'xs' => 'w-3 h-3',
        'sm' => 'w-4 h-4' /* DEFAULT  */,
        'md' => 'w-5 h-5',
        'lg' => 'w-6 h-6',
        'xl' => 'w-7 h-7',
    ];
    $roundedes = [
        'none' => 'rounded-none',
        'sm' => 'rounded-sm',
        'base' => 'rounded-sm' /* DEFAULT  */,
        'md' => 'rounded-md',
        'lg' => 'rounded-lg',
        'xl' => 'rounded-xl',
        '2xl' => 'rounded-2xl',
        '3xl' => 'rounded-3xl',
        'full' => 'rounded-full',
    ];
    // Seleccionar el tamaño según la prop activada
    $selectedSize = $sizes['sm']; // Default: sm
    foreach ($sizes as $key => $class) {
        if ($$key) {
            // Verifica si la prop ($xs, $sm, $md, etc.) está activada
            $selectedSize = $class;
            break; // Detenerse en la primera coincidencia
        }
    }
    // Si el valor de `rounded` está en el array, se usa el predefinido, sino se toma como custom
    $selectedRounded = $roundedes[$rounded] ?? $rounded;

    // Obtener todos los atributos como un array
    $attributeKeys = array_keys($attributes->getAttributes());

    // Buscar cualquier atributo que empiece con "wire:model"
    $wireModelKey = collect($attributeKeys)->first(fn($key) => strpos($key, 'wire:model') === 0);

    // Obtener el valor de wire:model sin modificarlo
    $name = $wireModelKey ? $attributes->get($wireModelKey) : $name ?? '';
@endphp

<div with-validation-colors="true" @if ($errors->has($for)) group-invalidated="true" @endif
    class="aria-disabled:pointer-events-none aria-disabled:select-none aria-disabled:opacity-60 aria-disabled:cursor-not-allowed aria-readonly:pointer-events-none aria-readonly:select-none relative {{ $class_father }}"
    form-wrapper="{{ $id }}">
    <div class="flex items-center gap-x-2">
        <input type="radio" id="{{ $id }}"
            @if (!$attributes->has('wire:model')) @checked(old('published', $pluck) == $field) @endif
            {{ $attributes->merge([
                'class' =>
                    'form-radio transition ease-in-out duration-100 ' .
                    $selectedRounded .
                    ' border-secondary-300 text-primary-600 focus:ring-primary-600 focus:border-primary-400 dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600 dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600 dark:focus:ring-offset-secondary-800 ' .
                    $selectedSize .
                    ' invalidated:focus:ring-negative-500 invalidated:ring-negative-500 invalidated:border-negative-400 invalidated:text-negative-600 invalidated:focus:border-negative-400 invalidated:dark:focus:border-negative-600 invalidated:dark:ring-negative-600 invalidated:dark:border-negative-600 invalidated:dark:bg-negative-700 invalidated:dark:checked:bg-negative-700 invalidated:dark:focus:ring-offset-secondary-800 invalidated:dark:checked:border-negative-700',
                'name' => $name, // Aquí se asigna dinámicamente el name
            ]) }} />

        <label
            class="block text-sm font-medium disabled:opacity-60 text-gray-700 dark:text-gray-400 invalidated:text-negative-600 dark:invalidated:text-negative-700"
            for="{{ $id }}">
            {{ $label }}
        </label>
    </div>
</div>
