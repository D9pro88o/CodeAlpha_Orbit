<?php

namespace App\Livewire;
use App\Models\Project;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateProject extends Component
{
    #[Rule('required|min:3|max:100')]
    public $name = '';

    #[Rule('nullable|max:500')]
    public $description = '';
    
    public function save (){
        $this->validate();

        $project = Project::create([
            'name' => $this->name,
            'description' => $this->description,
            'user_id'=> auth()->id(),
        ]);

        $project->members()->attach(auth()->id(), ['role' => 'owner']);

        $this->reset(['name' , 'description']);

        $this->dispatch('project-created');
        session()->flash('message','Project created successfully!');
    }

    public function render()
    {
        return view('livewire.create-project');
    }
}
