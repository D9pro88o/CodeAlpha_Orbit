<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function members(){
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    public function taskLists(){
        return $this->hasMany(TaskList::class)->orderBy('position');
    }

    public function hasMember(User $user){
        return $this->user_id === $user->id || $this->members->contains($user);
    }
}
