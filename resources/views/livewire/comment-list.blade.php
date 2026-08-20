<div class="border-t border-gray-100 pt-4 mt-5">
    <p class="font-mono text-xs uppercase tracking-widest text-orbit-teal mb-3">Comments</p>

    <div class="space-y-3 max-h-48 overflow-y-auto mb-4">
        @forelse ($comments as $comment)
            <div class="flex items-start gap-2.5">
                <x-orbit-avatar :name="$comment->user->name" size="xs" />

                <div class="flex-1 bg-panel-slate/5 rounded-lg px-3 py-2">
                    <div class="flex justify-between items-start">
                        <p class="text-xs font-medium text-ink-text">{{ $comment->user->name }}</p>
                        @if ($comment->user_id === auth()->id())
                            <button wire:click="deleteComment({{ $comment->id }})"
                                    wire:confirm="Delete this comment?"
                                    class="text-ink-text/30 hover:text-red-500 text-xs">
                                ✕
                            </button>
                        @endif
                    </div>
                    <p class="text-sm text-ink-text/80 mt-0.5">{{ $comment->body }}</p>
                    <p class="font-mono text-[10px] text-ink-text/40 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @empty
            <p class="text-xs text-ink-text/40">No comments yet. Start the conversation.</p>
        @endforelse
    </div>

    <form wire:submit="addComment" class="flex gap-2">
        <input type="text" wire:model="body" placeholder="Write a comment..."
               class="flex-1 border border-gray-300 rounded-md px-3 py-2 text-sm focus:border-signal-amber focus:ring-signal-amber">
        <button type="submit" class="bg-ink-navy text-canvas px-3 py-2 rounded-md text-sm">
            Send
        </button>
    </form>
    @error('body') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
</div>