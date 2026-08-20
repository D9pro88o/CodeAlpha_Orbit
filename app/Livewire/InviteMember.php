<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;

class InviteMember extends Component
{
    public Project $project;

    #[Rule('required|email')]
    public $email = '';

    public $errorMessage = '';
    public $successMessage = '';

    public function invite()
    {
        if (! auth()->user()->can('addMember', $this->project)) {
            $this->errorMessage = 'Only the project owner can add members.';
            return;
        }
        $this->validate();
        $this->errorMessage = '';
        $this->successMessage = '';

        $user = User::where('email', $this->email)->first();

        if (! $user) {
            $this->errorMessage = 'No user found with that email. They need to register first.';
            return;
        }

        if ($this->project->hasMember($user)) {
            $this->errorMessage = 'This user is already a member of the project.';
            return;
        }

        $this->project->members()->attach($user->id, ['role' => 'member']);

        $this->successMessage = "{$user->name} has been added to the project.";
        $this->reset('email');

        $this->dispatch('member-added');
    }

    public function render()
    {
        return view('livewire.invite-member', [
            'members' => $this->project->members,
        ]);
    }
}
