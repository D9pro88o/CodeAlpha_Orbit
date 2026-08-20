<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OrbitAvatar extends Component
{
    public string $initials;

    public function __construct(public string $name, public string $size = 'sm')
    {
        $parts = explode(' ', trim($name));
        $this->initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
    }

    public function render()
    {
        return view('components.orbit-avatar');
    }
}