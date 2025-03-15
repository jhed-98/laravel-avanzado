@props([
    'key',
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

<div with-validation-colors="true" @if ($errors->has($for)) group-invalidated="true" @endif
    class="{{ $class_father }}">
    {{-- Label con color rojo si hay error --}}
    @if ($label)
        <label for="{{ $for }}"
            class="block mb-2 text-sm font-medium {{ $error ? 'invalidated:text-negative-600 dark:invalidated:text-negative-700' : '' }}">
            {{ $customLabel ?: $label }}
        </label>
    @endif

    {{-- Select con validación de error --}}
    <select id="{{ $for }}"
        {{ $attributes->merge([
            'class' =>
                'rounded-md text-[.9em] border-0 w-full focus-within:ring-primary-600 shadow bg-background-white dark:bg-background-dark relative flex justify-between gap-x-2 items-center transition-all ease-in-out duration-150 ring-1 ring-inset ring-gray-300 focus-within:ring-2 outline-0 pl-3 pr-3 py-2',
        ]) }}>
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
                <option value="{{ intval($element->id) }}"
                    @if ($collection) @selected(collect(old($for, $pluck))->contains(intval($element->id))) @else @selected(old($for, $pluck) == $element->id) @endif>
                    {{ $relation_key ? $element->$relation_key->name : $element->name }}
                </option>
            @endforeach
        @endif
    </select>

    {{-- Mensaje de error opcional --}}
    @if ($error)
        <label class="text-sm text-negative-600 mt-2" for="{{ $for }}">
            {{ $error }}
        </label>
    @endif
</div>
