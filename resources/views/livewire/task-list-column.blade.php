<div class="min-w-[280px] max-w-[280px] flex-shrink-0">
    <div class="flex items-center justify-between mb-3 px-1 group">
        <h3 class="font-display font-semibold text-sm text-ink-text uppercase tracking-wide">
            {{ $taskList->name }}
        </h3>
        <div class="flex items-center gap-2">
            <span class="font-mono text-xs text-ink-text/40 bg-white border border-gray-200 rounded-full px-2 py-0.5">
                {{ $tasks->count() }}
            </span>
            @can('delete', $taskList->project)
                <button wire:click="delete"
                        wire:confirm="Delete this list and all its tasks?"
                        class="text-gray-300 hover:text-red-500 opacity-0 group-hover:opacity-100 text-xs">
                    ✕
                </button>
            @endcan
        </div>
    </div>

    <div class="bg-panel-slate/5 border border-gray-200 rounded-lg p-2 space-y-2 min-h-[60px]">
        @foreach ($tasks as $task)
            <livewire:task-card :task="$task" :key="'task-'.$task->id" />
        @endforeach

        <livewire:create-task :taskList="$taskList" :key="'create-task-'.$taskList->id" />
    </div>
</div>