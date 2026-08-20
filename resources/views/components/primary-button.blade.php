<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-ink-navy border border-transparent rounded-md font-semibold text-xs text-canvas uppercase tracking-widest hover:bg-panel-slate focus:outline-none focus:ring-2 focus:ring-signal-amber focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>