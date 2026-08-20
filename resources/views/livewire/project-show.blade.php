<div>
    <div class="flex justify-between items-start mb-6">
        <div>
            <p class="font-mono text-xs uppercase tracking-widest text-orbit-teal mb-1">Project</p>
            <h1 class="font-display text-3xl font-bold text-ink-text">{{ $project->name }}</h1>
            <p class="text-ink-text/60 mt-1">{{ $project->description }}</p>
        </div>

        @can('delete', $project)
            <button wire:click="deleteProject"
                    wire:confirm="Delete this project? This will permanently remove all its lists, tasks, and comments."
                    class="font-mono text-xs uppercase tracking-wide text-red-500 hover:text-red-700 border border-red-200 rounded px-3 py-2">
                Delete Project
            </button>
        @endcan
    </div>

    <livewire:invite-member :project="$project" :key="'invite-' . $project->id" />

    <div class="flex gap-4 overflow-x-auto pb-4 -mx-4 px-4">
        @foreach ($taskLists as $taskList)
            <livewire:task-list-column :taskList="$taskList" :key="'list-' . $taskList->id" />
        @endforeach

        <livewire:create-task-list :project="$project" :key="'create-list-' . $project->id" />
    </div>

    <livewire:task-detail-modal :project="$project" :key="'modal-' . $project->id" />
</div>