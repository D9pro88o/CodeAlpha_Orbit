<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Notifications\Notification;

class TaskCommented extends Notification
{
    public function __construct(public Comment $comment) {}

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return new \Illuminate\Notifications\Messages\BroadcastMessage($this->toDatabase($notifiable));
    }

    public function toDatabase($notifiable)
    {
        return [
            'task_id' => $this->comment->task_id,
            'task_title' => $this->comment->task->title,
            'project_id' => $this->comment->task->taskList->project_id,
            'commenter_name' => $this->comment->user->name,
            'message' => "{$this->comment->user->name} commented on \"{$this->comment->task->title}\"",
        ];
    }
}
