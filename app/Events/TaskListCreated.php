<?php

namespace App\Events;

use App\Models\TaskList;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskListCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public TaskList $taskList)
    {
    }

    public function broadcastOn()
    {
        return new PrivateChannel("project.{$this->taskList->project_id}");
    }

    public function broadcastWith()
    {
        return [
            'task_list_id' => $this->taskList->id,
        ];
    }

    public function broadcastAs()
    {
        return 'task-list-created';
    }
}