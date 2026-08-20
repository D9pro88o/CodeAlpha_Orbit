<div>
    @if ($showModal)
        <div class="fixed inset-0 bg-ink-navy/60 flex items-center justify-center z-50"
             wire:click.self="close">
            <div class="bg-white rounded-lg p-6 w-full max-w-md max-h-[85vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-5">
                    <p class="font-mono text-xs uppercase tracking-widest text-orbit-teal">Task Details</p>
                    <button wire:click="close" class="text-ink-text/40 hover:text-ink-text">✕</button>
                </div>

                <form wire:submit="save" class="space-y-4">
                    <div>
                        <label class="font-mono text-xs uppercase tracking-wide text-ink-text/50">Title</label>
                        <input type="text" wire:model="title"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:border-signal-amber focus:ring-signal-amber">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="font-mono text-xs uppercase tracking-wide text-ink-text/50">Description</label>
                        <textarea wire:model="description" rows="3"
                                  class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:border-signal-amber focus:ring-signal-amber"></textarea>
                    </div>

                    <div>
                        <label class="font-mono text-xs uppercase tracking-wide text-ink-text/50">Assignee</label>
                        <select wire:model="assigned_to"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:border-signal-amber focus:ring-signal-amber">
                            <option value="">Unassigned</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="font-mono text-xs uppercase tracking-wide text-ink-text/50">Due Date</label>
                        <input type="date" wire:model="due_date"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:border-signal-amber focus:ring-signal-amber">
                    </div>

                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" wire:click="close" class="text-ink-text/50 px-4 py-2 text-sm">
                            Cancel
                        </button>
                        <button type="submit" class="bg-ink-navy text-canvas font-medium px-4 py-2 rounded-md hover:bg-panel-slate transition text-sm">
                            Save
                        </button>
                    </div>
                </form>

                @if ($task)
                    <livewire:comment-list :task="$task" :key="'comments-'.$task->id" />
                @endif
            </div>
        </div>
    @endif
</div>