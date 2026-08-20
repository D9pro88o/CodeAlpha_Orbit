<div>
    @if (!$showForm)
        <button wire:click="$set('showForm', true)"
                class="w-full text-left font-mono text-xs text-ink-text/40 hover:text-orbit-teal px-1 py-1.5">
            + Add a card
        </button>
    @else
        <form wire:submit="save" class="space-y-2">
            <textarea wire:model="title" placeholder="Task title" rows="2"
                      class="w-full border border-gray-300 rounded px-2 py-1.5 text-sm focus:border-signal-amber focus:ring-signal-amber" autofocus></textarea>
            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

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