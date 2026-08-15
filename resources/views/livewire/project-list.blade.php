<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">My Projects</h1>
    </div>

    <livewire:create-project />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        @forelse ($projects as $project)
            <a href="{{ route('projects.show', $project) }}"
               class="block p-4 border rounded-lg shadow-sm hover:shadow-md transition">
                <h2 class="font-semibold text-lg">{{ $project->name }}</h2>
                <p class="text-gray-500 text-sm mt-1">{{ Str::limit($project->description, 80) }}</p>
                <p class="text-xs text-gray-400 mt-2">Owner: {{ $project->owner->name }}</p>
            </a>
        @empty
            <p class="text-gray-500">No projects yet. Create your first one above.</p>
        @endforelse
    </div>
</div>