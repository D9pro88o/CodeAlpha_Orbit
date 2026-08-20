<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\TaskList;
use App\Events\TaskCreated;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateTask extends Component
{
    public TaskList $taskList;

    #[Rule('required|min:1|max:150')]
    public $title = '';

    public $showForm = false;

    public function save()
    {
        $this->validate();

        $maxPosition = $this->taskList->tasks()->max('position') ?? 0;

        $task = Task::create([
            'task_list_id' => $this->taskList->id,
            'title' => $this->title,
            'created_by' => auth()->id(),
            'position' => $maxPosition + 1,
        ]);

        broadcast(new TaskCreated($task))->toOthers();

        $this->reset(['title', 'showForm']);
        $this->dispatch('task-created');
    }

    public function render()
    {
        return view('livewire.create-task');
    }
}
