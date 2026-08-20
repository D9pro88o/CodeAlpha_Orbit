<?php

namespace App\Livewire;

use App\Models\TaskList;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskListColumn extends Component
{
    public TaskList $taskList;

    #[On('task-created')]
    #[On('task-deleted')]
    #[On('task-updated')]
    public function refreshTasks()
    {
        //
    }


    public function delete()
    {
        $this->authorize('delete', $this->taskList->project);

        $projectId = $this->taskList->project_id;

        $this->taskList->delete(); // cascades to delete its tasks too (from Step 2's migration)

        $this->dispatch('task-list-deleted');
    }

    public function render()
    {
        $tasks = $this->taskList->tasks()->orderBy('position')->get();

        return view('livewire.task-list-column', [
            'tasks' => $tasks,
        ]);
    }
}
