@props([
    'label' => false,
    'for' => '',
    'error' => false,
    'type' => 'text',
    'addOnLeft' => false,
    'addOnRight' => false,
    'disabled' => false,
    'customLabel' => false,
    'infotext' => false,
])

<div class="mb-4">
    {{-- Label opcional con color rojo si hay error --}}
    @if ($label)
        <label for="{{ $for }}"
            class="block mb-2 text-sm font-medium {{ $error ? 'text-negative-600 ' : 'text-gray-900 dark:text-white' }}">
            {{ $customLabel ?: $label }}
        </label>
    @endif

    <div class="relative">
        {{-- Icono o texto a la izquierda --}}
        @if ($addOnLeft)
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                {{ $addOnLeft }}
            </span>
        @endif

        {{-- Input con clases dinámicas según error --}}
        <input type="{{ $type }}" id="{{ $for }}" {{ $disabled ? 'disabled' : '' }}
            placeholder="{{ $attributes->get('placeholder') ?? '' }}"
            {{ $attributes->merge([
                'class' =>
                    'border text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500' .
                    ($addOnLeft ? 'pl-10' : '') .
                    ($addOnRight ? 'pr-10' : '') .
                    ($error
                        ? ' border-red-500 bg-negative-50 focus:ring-red-600 focus:border-red-500 placeholder-negative-800'
                        : ' border-gray-300 bg-gray-50'),
            ]) }} />

        {{-- Icono de advertencia cuando hay error --}}
        @if ($error)
            <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-red-500">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8zM9 7a1 1 0 112 0v4a1 1 0 11-2 0V7zm1 8a1 1 0 100-2 1 1 0 000 2z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
        @endif
    </div>

    {{-- Texto de ayuda opcional --}}
    @if ($infotext)
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $infotext }}</p>
    @endif

    {{-- Mensaje de error opcional --}}
    @if ($error)
        <p class="mt-1 text-xs text-negative-500 flex items-center">
            {{ $error }}
        </p>
    @endif
</div>
