<div class="border border-gray-200 rounded-lg p-4 bg-white mb-6">
    <p class="font-mono text-xs uppercase tracking-widest text-orbit-teal mb-3">Project Members</p>

    <div class="flex flex-wrap gap-3 mb-4">
        @foreach ($members as $member)
            <div class="flex items-center gap-2 bg-panel-slate/5 border border-gray-200 rounded-full pl-1 pr-3 py-1">
                <x-orbit-avatar :name="$member->name" size="xs" />
                <span class="text-xs text-ink-text">{{ $member->name }}</span>
                @if ($member->pivot->role === 'owner')
                    <span class="font-mono text-[10px] text-signal-amber">OWNER</span>
                @endif
            </div>
        @endforeach
    </div>

    <form wire:submit="invite" class="flex gap-2">
        <input type="email" wire:model="email" placeholder="Invite by email"
               class="flex-1 border border-gray-300 rounded-md px-3 py-2 text-sm focus:border-signal-amber focus:ring-signal-amber">
        <button type="submit" class="bg-ink-navy text-canvas px-4 py-2 rounded-md text-sm">
            Add
        </button>
    </form>
    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

    @if ($errorMessage)
        <p class="text-red-500 text-xs mt-2">{{ $errorMessage }}</p>
    @endif
    @if ($successMessage)
        <p class="text-orbit-teal text-xs mt-2">{{ $successMessage }}</p>
    @endif
</div>