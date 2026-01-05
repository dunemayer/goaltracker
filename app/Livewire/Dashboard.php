<?php

namespace App\Livewire;

use App\Models\Goal;
use Livewire\Component;
use Livewire\Attributes\Computed;

class Dashboard extends Component
{
    #[Computed]
    public function goals()
    {
        return Goal::with('persona')->get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
