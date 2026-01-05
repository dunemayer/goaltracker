<?php

namespace App\Livewire;

use App\Models\CheckIn;
use App\Models\Measurable;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CheckInForm extends Component
{
    public $step = 1;
    public $type = 'weekly';
    public $measurableData = [];

    public function mount()
    {
        $this->initializeMeasurableData();
    }

    public function updatedType()
    {
        $this->initializeMeasurableData();
    }

    protected function initializeMeasurableData()
    {
        $this->measurableData = [];
        foreach ($this->measurables() as $persona => $measurables) {
            foreach ($measurables as $measurable) {
                $this->measurableData[$measurable->id] = [
                    'status' => null,
                    'value' => null,
                    'description' => null,
                ];
            }
        }
    }

    #[Computed]
    public function measurables()
    {
        return Measurable::with(['goal', 'persona'])
            ->where('check_in_type', $this->type)
            ->get()
            ->groupBy(function ($measurable) {
                // Group by the measurable's persona, or fall back to goal's persona if null
                return $measurable->persona?->name ?? $measurable->goal?->persona?->name ?? '';
            });
    }

    public function save()
    {
        $this->validate([
            'type' => 'required|in:weekly,monthly',
            'measurableData.*.status' => 'nullable|in:succeeded,failed',
            'measurableData.*.value' => 'nullable',
            'measurableData.*.description' => 'nullable|string',
        ]);

        // Create the check-in
        $checkIn = CheckIn::create([
            'type' => $this->type,
        ]);

        // Attach measurables with their data
        foreach ($this->measurableData as $measurableId => $data) {
            $measurable = Measurable::find($measurableId);

            $pivotData = [
                'status' => $data['status'],
                'description' => $data['description'],
            ];

            // Store value in the appropriate column based on unit type
            if ($measurable->do_measurement && $data['value'] !== null) {
                if ($measurable->unit === 'integer') {
                    $pivotData['integer_value'] = $data['value'];
                } elseif ($measurable->unit === 'string') {
                    $pivotData['string_value'] = $data['value'];
                }
            }

            $checkIn->measurables()->attach($measurableId, $pivotData);
        }

        session()->flash('message', 'Check-in saved successfully!');

        return $this->redirect(route('check-ins.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.check-in-form');
    }
}
