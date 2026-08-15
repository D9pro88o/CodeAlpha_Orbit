<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ProjectList extends Component
{
    public function render()
    {
        $projects = auth()->user()->projects()->latest()->get();
        return view('livewire.project-list' , [
            'projects' => $projects,
        ]);
    }
}
