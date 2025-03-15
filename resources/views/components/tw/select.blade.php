@props([
    'key',
    'option' => false,
    'label' => false,
    'for',
    'error' => false,
    'relation_key' => false,
    'name' => '',
    'disabled' => false,
    'customLabel' => false,
])

<div class="mb-4">
    {{-- Label con color rojo si hay error --}}
    @if ($label)
        <label for="{{ $for }}"
            class="block mb-2 text-sm font-medium {{ $error ? 'text-red-600' : 'text-gray-900 dark:text-white' }}">
            {{ $customLabel ?: $label }}
        </label>
    @endif

    {{-- Select con validación de error --}}
    <select id="{{ $for }}" name="{{ $name }}" {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->merge([
            'class' =>
                'bg-gray-50 border text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500' .
                ($error
                    ? ' border-red-500 bg-red-50 focus:ring-red-600 focus:border-red-500 placeholder-red-400'
                    : ' border-gray-300'),
        ]) }}>

        <option disabled selected value="">{{ $option }}</option>
        @if (is_array($key))
            @foreach ($key as $key => $element)
                <option value="{{ $key }}">
                    {{ $element }}
                </option>
            @endforeach
        @else
            @foreach ($key as $element)
                <option value="{{ intval($element->id) }}">
                    {{ $relation_key ? $element->$relation_key->name : $element->name }}
                </option>
            @endforeach
        @endif
    </select>

    {{-- Mensaje de error opcional --}}
    @if ($error)
        <p class="mt-1 text-xs text-red-500 flex items-center">
            {{ $error }}
        </p>
    @endif
</div>
