<div class="space-y-8">
    <flux:heading size="xl">Check-Ins</flux:heading>

    <div class="space-y-6">
        <flux:input
            wire:model.live="search"
            placeholder="Search by date or month..."
            icon="magnifying-glass"
        />

        <flux:separator />

        {{-- Weekly Check-Ins --}}
        <flux:card>
            <flux:heading size="lg">Weekly Check-Ins</flux:heading>
            <flux:subheading>Your weekly progress and updates</flux:subheading>

            <flux:separator class="my-4" />

            @if ($this->weeklyCheckIns->isEmpty())
                <flux:text>
                    No weekly check-ins found.
                    <flux:link href="{{ route('check-ins.create') }}">Create your first one</flux:link>
                </flux:text>
            @else
                <div class="space-y-3">
                    @foreach ($this->weeklyCheckIns as $checkIn)
                        <flux:card>
                            <div class="flex items-center justify-between">
                                <div>
                                    <flux:heading size="base">
                                        {{ $checkIn->created_at->format('F d, Y') }}
                                    </flux:heading>
                                    <flux:subheading>
                                        {{ $checkIn->measurables->count() }} measurables tracked
                                    </flux:subheading>
                                </div>
                                <flux:button
                                    size="sm"
                                    wire:click="openCheckIn({{ $checkIn->id }})"
                                >
                                    View Details
                                </flux:button>
                            </div>
                        </flux:card>
                    @endforeach
                </div>
            @endif
        </flux:card>

        {{-- Monthly Check-Ins --}}
        <flux:card>
            <flux:heading size="lg">Monthly Check-Ins</flux:heading>
            <flux:subheading>Your monthly financial progress</flux:subheading>

            <flux:separator class="my-4" />

            @if ($this->monthlyCheckIns->isEmpty())
                <flux:text>
                    No monthly check-ins found.
                    <flux:link href="{{ route('check-ins.create') }}">Create your first one</flux:link>
                </flux:text>
            @else
                <div class="space-y-3">
                    @foreach ($this->monthlyCheckIns as $checkIn)
                        <flux:card>
                            <div class="flex items-center justify-between">
                                <div>
                                    <flux:heading size="base">
                                        {{ $checkIn->created_at->format('F Y') }}
                                    </flux:heading>
                                    <flux:subheading>
                                        {{ $checkIn->measurables->count() }} measurables tracked
                                    </flux:subheading>
                                </div>
                                <flux:button
                                    size="sm"
                                    wire:click="openCheckIn({{ $checkIn->id }})"
                                >
                                    View Details
                                </flux:button>
                            </div>
                        </flux:card>
                    @endforeach
                </div>
            @endif
        </flux:card>
    </div>

    {{-- Check-In Details Modal --}}
    <flux:modal name="check-in-details" wire:model="showModal" class="max-w-lg">
        @if ($this->selectedCheckIn)
            <flux:heading size="lg">
                Check-In Details
            </flux:heading>

            <flux:subheading>
                {{ $this->selectedCheckIn->created_at->format('F d, Y') }} -
                {{ ucfirst($this->selectedCheckIn->type) }}
            </flux:subheading>

            <flux:separator class="my-4" />

            <div class="space-y-6">
                @foreach ($this->selectedCheckIn->measurables->groupBy(fn($m) => $m->persona?->name ?? $m->goal?->persona?->name ?? 'Together') as $persona => $measurables)
                    <div class="space-y-4">
                        <flux:heading size="base">
                            {{ $persona === 'Together' ? $persona : ucfirst($persona) }}'s Progress
                        </flux:heading>

                        @foreach ($measurables as $measurable)
                            <div class="space-y-2">
                                <flux:text>
                                    <strong>{{ $measurable->name }}</strong>
                                </flux:text>

                                <div class="flex items-center space-x-2">
                                    @if ($measurable->pivot->status)
                                        <flux:badge
                                            size="sm"
                                            :color="$measurable->pivot->status === 'succeeded' ? 'green' : 'red'"
                                        >
                                            {{ ucfirst($measurable->pivot->status) }}
                                        </flux:badge>
                                    @endif
                                    @if ($measurable->pivot->integer_value)
                                        <flux:badge size="sm">
                                            Value: {{ $measurable->pivot->integer_value }}
                                        </flux:badge>
                                    @endif
                                </div>

                                @if ($measurable->pivot->string_value)
                                    <flux:text>
                                        Value: {{ $measurable->pivot->string_value }}
                                    </flux:text>
                                @endif

                                @if ($measurable->pivot->description)
                                    <flux:text>
                                        {{ $measurable->pivot->description }}
                                    </flux:text>
                                @endif

                                @if (!$loop->last)
                                    <flux:separator />
                                @endif
                            </div>
                        @endforeach
                    </div>

                    @if (!$loop->last)
                        <flux:separator />
                    @endif
                @endforeach
            </div>

            <flux:button variant="ghost" wire:click="closeModal" class="mt-6">
                Close
            </flux:button>
        @endif
    </flux:modal>
</div>
