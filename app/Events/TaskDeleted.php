<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

class TaskDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public int $taskId, public int $projectId) {}

    public function broadcastOn()
    {
        return new PrivateChannel("project.{$this->projectId}");
    }

    public function broadcastWith()
    {
        return ['task_id' => $this->taskId];
    }

    public function broadcastAs()
    {
        return 'task-deleted';
    }
}