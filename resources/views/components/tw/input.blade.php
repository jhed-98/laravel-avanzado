@props([
    'type' => 'text',
    'name',
    'label',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'model' => null, // Para Livewire (opcional)
])

@php
    $id = $attributes->get('id', $name);

    $baseClasses = 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5';

    // Si está deshabilitado, agregar estilos adicionales
    if ($disabled) {
        $baseClasses .= ' bg-gray-100 cursor-not-allowed';
    }
@endphp

<div {{ $attributes->merge(['class' => $widthClass . ' mb-5']) }}>
    <label for="{{ $id }}" class="block mb-2 text-sm font-medium text-gray-900">
        {{ $label }}
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        {{ $model ? "wire:model=$model" : '' }}
        class="{{ $baseClasses }}"
        {{ $attributes }}
    />
</div>
