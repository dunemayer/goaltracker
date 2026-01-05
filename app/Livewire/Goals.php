<?php

namespace App\Livewire;

use App\Models\Goal;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Goals extends Component
{
    public bool $showEditModal = false;
    public ?int $editingGoalId = null;
    public string $editTitle = '';
    public string $editDescription = '';
    public array $measurables = [];

    #[Computed]
    public function goals()
    {
        return Goal::with('persona')
            ->where('show', true)
            ->orderBy('order')
            ->get()
            ->groupBy(function ($goal) {
                return $goal->persona?->name ?? 'General';
            });
    }

    public function editGoal(int $goalId)
    {
        $goal = Goal::with('measurables')->find($goalId);

        if ($goal) {
            $this->editingGoalId = $goalId;
            $this->editTitle = $goal->title;
            $this->editDescription = $goal->description ?? '';
            $this->measurables = $goal->measurables->map(function ($measurable) {
                return [
                    'id' => $measurable->id,
                    'name' => $measurable->name,
                ];
            })->toArray();
            $this->showEditModal = true;
        }
    }

    public function saveGoal()
    {
        $this->validate([
            'editTitle' => 'required|string|max:255',
            'editDescription' => 'nullable|string',
            'measurables.*.name' => 'required|string|max:255',
        ]);

        $goal = Goal::find($this->editingGoalId);

        if ($goal) {
            $goal->update([
                'title' => $this->editTitle,
                'description' => $this->editDescription ?: null,
            ]);

            // Update measurables
            foreach ($this->measurables as $measurableData) {
                if (isset($measurableData['id'])) {
                    $measurable = \App\Models\Measurable::find($measurableData['id']);
                    if ($measurable) {
                        $measurable->update([
                            'name' => $measurableData['name'],
                        ]);
                    }
                }
            }
        }

        $this->closeEditModal();
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->editingGoalId = null;
        $this->editTitle = '';
        $this->editDescription = '';
        $this->measurables = [];
    }

    public function render()
    {
        return view('livewire.goals');
    }
}
