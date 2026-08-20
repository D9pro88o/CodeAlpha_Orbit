@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-signal-amber focus:ring-signal-amber rounded-md shadow-sm w-full']) }}>