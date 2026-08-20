<div class="border border-gray-200 rounded-lg p-5 bg-white">
    @if (session('message'))
        <div class="font-mono text-xs text-orbit-teal mb-3 uppercase tracking-wide">
            ✓ {{ session('message') }}
        </div>
    @endif

    <form wire:submit="save" class="space-y-3">
        <div>
            <input type="text" wire:model="name" placeholder="Project name"
                   class="w-full border border-gray-300 rounded-md px-3 py-2.5 font-sans text-ink-text placeholder:text-ink-text/40 focus:border-signal-amber focus:ring-signal-amber">
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <textarea wire:model="description" placeholder="Description (optional)"
                      class="w-full border border-gray-300 rounded-md px-3 py-2.5 font-sans text-ink-text placeholder:text-ink-text/40 focus:border-signal-amber focus:ring-signal-amber"></textarea>
        </div>

        <button type="submit"
                class="bg-ink-navy text-canvas font-medium px-5 py-2.5 rounded-md hover:bg-panel-slate transition">
            Create Project
        </button>
    </form>
</div>