<div wire:click="openModal"
     class="bg-white border border-gray-200 rounded-md p-3 shadow-sm hover:border-signal-amber hover:shadow transition cursor-pointer text-sm group relative">
    <p class="text-ink-text pr-4">{{ $task->title }}</p>

    @if ($task->description)
        <p class="text-xs text-ink-text/50 mt-1 line-clamp-2">{{ $task->description }}</p>
    @endif

    <div class="flex items-center justify-between mt-3">
        <div class="flex items-center gap-2">
            @if ($task->due_date)
                <span class="font-mono text-[10px] text-ink-text/40 uppercase">
                    {{ $task->due_date->format('M d') }}
                </span>
            @endif
        </div>

        @if ($task->assignee)
            <x-orbit-avatar :name="$task->assignee->name" size="xs" />
        @endif
    </div>

    <button wire:click.stop="delete"
            wire:confirm="Delete this task?"
            class="absolute top-2 right-2 text-gray-300 hover:text-red-500 opacity-0 group-hover:opacity-100 text-xs">
        ✕
    </button>
</div>