<div>
    <div class="flex justify-between items-center mb-8">
        <div>
            <p class="font-mono text-xs uppercase tracking-widest text-orbit-teal mb-1">Mission Control</p>
            <h1 class="font-display text-3xl font-bold text-ink-text">My Projects</h1>
        </div>
    </div>

    <livewire:create-project />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
        @forelse ($projects as $project)
            <a href="{{ route('projects.show', $project) }}"
               class="block p-5 bg-white border border-gray-200 rounded-lg hover:border-signal-amber hover:shadow-md transition">
                <h2 class="font-display font-semibold text-lg text-ink-text">{{ $project->name }}</h2>
                <p class="text-sm text-ink-text/60 mt-1.5 line-clamp-2">{{ $project->description }}</p>
                <p class="font-mono text-xs text-orbit-teal mt-4 uppercase tracking-wide">
                    Owner · {{ $project->owner->name }}
                </p>
            </a>
        @empty
            <div class="col-span-3 border border-dashed border-gray-300 rounded-lg p-10 text-center">
                <p class="text-ink-text/50">No projects in orbit yet. Launch your first one above.</p>
            </div>
        @endforelse
    </div>
</div>