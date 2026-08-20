<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ProjectShow extends Component
{
    public Project $project;

    public $listeners = [];

    public function mount(Project $project)
    {
        $this->authorize('view', $project);
        $this->project = $project;
        $this->listeners = [
            'task-list-created' => 'refreshBoard',
            'task-list-deleted' => 'refreshBoard',
            "echo-private:project.{$this->project->id},task-created" => 'refreshBoard',
            "echo-private:project.{$this->project->id},task-updated" => 'refreshBoard',
            "echo-private:project.{$this->project->id},task-deleted" => 'refreshBoard',
            "echo-private:project.{$this->project->id},task-list-created" => 'refreshBoard',
        ];
    }
    public function deleteProject()
    {
        $this->authorize('delete', $this->project);

        $this->project->delete();

        session()->flash('message', 'Project deleted.');

        return $this->redirect(route('projects.index'), navigate: true);
    }

    public function refreshBoard()
    {
        //
    }

    public function render()
    {
        $taskLists = $this->project->taskLists()->with('tasks')->get();

        return view('livewire.project-show', [
            'taskLists' => $taskLists,
        ]);
    }
}
