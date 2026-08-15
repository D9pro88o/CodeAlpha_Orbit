<?php

namespace App\Models;

use Dom\Comment;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'task_list_id',
        'assigned_to',
        'created_by',
        'description',
        'due_date',
        'position',
    ];

    protected $casts =[
        'due_date' => 'date',
    ];

    public function taskList(){
        return $this->belongsTo(TaskList::class);
    }

    public function assignee(){
        return $this->belongsTo(User::class,'assigned_to');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function comments(){
        return $this->hasMany(Comment::class)->latest();
    }
}
