<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Notifications\TaskAssigned;
use App\Models\User;
use App\Events\TaskUpdated;

class TaskDetailModal extends Component
{
    public Project $project;
    public ?Task $task = null;
    public $showModal = false;

    public $title = '';
    public $description = '';
    public $assigned_to = '';
    public $due_date = '';

    #[On('open-task-modal')]
    public function open($taskId)
    {
        $this->task = Task::findOrFail($taskId);
        $this->title = $this->task->title;
        $this->description = $this->task->description;
        $this->assigned_to = $this->task->assigned_to;
        $this->due_date = $this->task->due_date?->format('Y-m-d');
        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
        $this->task = null;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|min:1|max:150',
            'description' => 'nullable|max:2000',
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        $previousAssignee = $this->task->assigned_to;

        $this->task->update([
            'title' => $this->title,
            'description' => $this->description,
            'assigned_to' => $this->assigned_to ?: null,
            'due_date' => $this->due_date ?: null,
        ]);
        
        broadcast(new TaskUpdated($this->task))->toOthers();

        // Notify only if assignee changed and isn't the current user assigning themselves
        if ($this->assigned_to && $this->assigned_to != $previousAssignee) {
            $newAssignee = User::find($this->assigned_to);
            if ($newAssignee && $newAssignee->id !== auth()->id()) {
                $newAssignee->notify(new TaskAssigned($this->task));
            }
        }

        $this->dispatch('task-updated');
        $this->close();
    }

    public function render()
    {
        $members = $this->project->members;

        return view('livewire.task-detail-modal', [
            'members' => $members,
        ]);
    }
}
