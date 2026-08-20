<div class="min-w-[280px] flex-shrink-0">
    @if (!$showForm)
        <button wire:click="$set('showForm', true)"
                class="w-full text-left font-mono text-xs uppercase tracking-wide text-ink-text/40 hover:text-orbit-teal border border-dashed border-gray-300 hover:border-orbit-teal rounded-lg px-3 py-2.5 transition">
            + Add another list
        </button>
    @else
        <form wire:submit="save" class="bg-white border border-gray-200 rounded-lg p-3 space-y-2">
            <input type="text" wire:model="name" placeholder="List name"
                   class="w-full border border-gray-300 rounded px-2 py-1.5 text-sm focus:border-signal-amber focus:ring-signal-amber" autofocus>
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

            <div class="flex gap-2">
                <button type="submit" class="bg-ink-navy text-canvas px-3 py-1.5 rounded text-sm">
                    Add
                </button>
                <button type="button" wire:click="$set('showForm', false)"
                        class="text-ink-text/50 text-sm">
                    Cancel
                </button>
            </div>
        </form>
    @endif
</div>