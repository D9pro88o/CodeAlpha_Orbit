<?php

namespace App\Livewire;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ProjectShow extends Component
{
    public Project $project;
    public function mount(Project $project){
        $this->authorize('view', $project);
        $this->project = $project;
    }
    public function render()
    {
        return view('livewire.project-show');
    }
}
