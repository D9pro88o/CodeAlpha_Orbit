<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Task;
use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Notifications\TaskCommented;

class CommentList extends Component
{
    public Task $task;

    #[Rule('required|min:1|max:1000')]
    public $body = '';

    public function addComment()
    {
        $this->validate();

        $comment = Comment::create([
            'task_id' => $this->task->id,
            'user_id' => auth()->id(),
            'body' => $this->body,
        ]);

        // Notify the assignee (if there is one, and it's not the commenter themself)
        if ($this->task->assigned_to && $this->task->assigned_to !== auth()->id()) {
            $this->task->assignee->notify(new TaskCommented($comment));
        }

        $this->reset('body');
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        // only the comment author can delete their own comment
        if ($comment->user_id === auth()->id()) {
            $comment->delete();
        }
    }

    public function render()
    {
        $comments = $this->task->comments()->with('user')->get();

        return view('livewire.comment-list', [
            'comments' => $comments,
        ]);
    }
}
