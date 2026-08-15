<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ProjectList;
use App\Livewire\ProjectShow;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function(){
    Route::get('/projects',ProjectList::class)->name('projects.index');
    Route::get('/projects/{project}',ProjectShow::class)->name('projects.show');
});

require __DIR__.'/auth.php';
