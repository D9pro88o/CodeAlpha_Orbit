<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'position'
    ];

    public function tasks(){
        return $this->hasMany(Task::class)->orderBy('position');
    }

    
}
