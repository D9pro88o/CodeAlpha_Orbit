<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Task $task) {}
    public function broadcastOn()
    {
        return new PrivateChannel("project.{$this->task->taskList->project_id}");
    }

    public function broadcastWith()
    {
        return [
            'task_id' => $this->task->id,
            'task_list_id' => $this->task->task_list_id,
        ];
    }

    public function broadcastAs()
    {
        return 'task-updated';
    }
}
