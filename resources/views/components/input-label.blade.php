@props(['value'])

<label {{ $attributes->merge(['class' => 'font-mono text-xs uppercase tracking-wide text-ink-text/50']) }}>
    {{ $value ?? $slot }}
</label>