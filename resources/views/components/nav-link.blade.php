@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-signal-amber text-sm font-medium leading-5 text-canvas focus:outline-none focus:border-signal-amber transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-canvas/60 hover:text-canvas hover:border-panel-slate focus:outline-none focus:text-canvas focus:border-panel-slate transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>