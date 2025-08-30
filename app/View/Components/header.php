<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class header extends Component
{
    public $user; // Tambahkan ini

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function render(): View|Closure|string
    {
        return view('components.header', [
            'user' => $this->user
        ]);
    }
}
