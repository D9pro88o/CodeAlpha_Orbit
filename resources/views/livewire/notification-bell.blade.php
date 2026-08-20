<div class="relative">
    <button wire:click="$toggle('showDropdown')" class="relative text-canvas/80 hover:text-canvas p-2">
        🔔
        @if ($unreadCount > 0)
            <span class="absolute top-0 right-0 bg-signal-amber text-ink-navy text-[10px] font-mono font-bold rounded-full px-1.5">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    @if ($showDropdown)
        <div class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-lg z-50 max-h-96 overflow-y-auto">
            <div class="flex justify-between items-center p-3 border-b border-gray-100">
                <span class="font-mono text-xs uppercase tracking-wide text-ink-text/60">Notifications</span>
                @if ($unreadCount > 0)
                    <button wire:click="markAllAsRead" class="text-xs text-orbit-teal hover:underline">
                        Mark all read
                    </button>
                @endif
            </div>

            @forelse ($notifications as $notification)
                <a href="{{ route('projects.show', $notification->data['project_id']) }}"
                   wire:click="markAsRead('{{ $notification->id }}')"
                   class="block p-3 border-b border-gray-100 text-sm hover:bg-panel-slate/5 {{ $notification->read_at ? 'opacity-50' : '' }}">
                    <p class="text-ink-text">{{ $notification->data['message'] }}</p>
                    <p class="font-mono text-[10px] text-ink-text/40 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                </a>
            @empty
                <p class="p-3 text-sm text-ink-text/40">No notifications yet.</p>
            @endforelse
        </div>
    @endif
</div>