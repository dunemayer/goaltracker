<?php

namespace App\Livewire;

use App\Models\CheckIn;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CheckInIndex extends Component
{
    public $search = '';
    public $selectedCheckInId = null;
    public $showModal = false;

    #[Computed]
    public function monthlyCheckIns()
    {
        return CheckIn::with(['measurables.goal', 'measurables.persona'])
            ->where('type', 'monthly')
            ->latest()
            ->get()
            ->filter(function ($checkIn) {
                if (empty($this->search)) {
                    return true;
                }
                return $checkIn->created_at->format('Y-m-d') === $this->search ||
                       str_contains($checkIn->created_at->format('F Y'), $this->search);
            });
    }

    #[Computed]
    public function weeklyCheckIns()
    {
        return CheckIn::with(['measurables.goal', 'measurables.persona'])
            ->where('type', 'weekly')
            ->latest()
            ->get()
            ->filter(function ($checkIn) {
                if (empty($this->search)) {
                    return true;
                }
                return $checkIn->created_at->format('Y-m-d') === $this->search ||
                       str_contains($checkIn->created_at->format('F Y'), $this->search);
            });
    }

    #[Computed]
    public function selectedCheckIn()
    {
        if (!$this->selectedCheckInId) {
            return null;
        }

        return CheckIn::with(['measurables.goal', 'measurables.persona'])
            ->find($this->selectedCheckInId);
    }

    public function openCheckIn($checkInId)
    {
        $this->selectedCheckInId = $checkInId;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedCheckInId = null;
    }

    public function render()
    {
        return view('livewire.check-in-index');
    }
}
