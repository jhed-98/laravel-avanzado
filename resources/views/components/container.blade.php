@props(['width' => '7xl'])
@php
    $sizes = [
        '7xl' => 'max-w-7xl',
        '6xl' => 'max-w-6xl',
        '5xl' => 'max-w-5xl',
        '4xl' => 'max-w-4xl',
        '3xl' => 'max-w-3xl',
        '2xl' => 'max-w-2xl',
        'xl' => 'max-w-xl',
        'lg' => 'max-w-lg',
        'md' => 'max-w-md',
        'sm' => 'max-w-sm',
        'full' => 'max-w-full',
    ];
    // Valor por defecto
    $widthClass = $sizes[$width] ?? 'max-w-7xl';
@endphp
<div {{ $attributes->merge(['class' => $widthClass . ' mx-auto px-4 md:px-6 lg:px-8']) }}>
    {{ $slot }}
</div>
