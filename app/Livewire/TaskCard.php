<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Events\TaskDeleted;

class TaskCard extends Component
{
    public Task $task;

    public function delete()
    {
        $taskId = $this->task->id;
        $projectId = $this->task->taskList->project_id; // grab these BEFORE deleting

        $this->task->delete();

        broadcast(new TaskDeleted($taskId, $projectId))->toOthers();

        $this->dispatch('task-deleted');
    }

    public function openModal()
    {
        $this->dispatch('open-task-modal', taskId: $this->task->id);
    }

    public function render()
    {
        return view('livewire.task-card');
    }
}
