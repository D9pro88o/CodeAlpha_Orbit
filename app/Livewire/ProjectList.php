<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class ProjectList extends Component
{
    #[On('project-created')]
    public function refreshProjects()
    {
        //
    }

    public function render()
    {
        $projects = auth()->user()->projects()->latest()->get();

        return view('livewire.project-list', [
            'projects' => $projects,
        ]);
    }
}