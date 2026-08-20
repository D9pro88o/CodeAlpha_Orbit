<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\TaskList;
use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Events\TaskListCreated;

class CreateTaskList extends Component
{
    public Project $project;

    #[Rule('required|min:1|max:50')]
    public $name = '';

    public $showForm = false;

    public function save()
    {
        $this->validate();

        $maxPosition = $this->project->taskLists()->max('position') ?? 0;

        $taskList = TaskList::create([
            'project_id' => $this->project->id,
            'name' => $this->name,
            'position' => $maxPosition + 1,
        ]);
        broadcast(new TaskListCreated($taskList))->toOthers();

        $this->reset(['name', 'showForm']);

        $this->dispatch('task-list-created');
    }

    public function render()
    {
        return view('livewire.create-task-list');
    }
}