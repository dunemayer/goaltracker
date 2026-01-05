<div class="space-y-12">
    @if (session()->has('message'))
        <flux:callout variant="success">
            {{ session('message') }}
        </flux:callout>
    @endif

    <flux:radio.group wire:model.live="type" label="What check-in are we doing?" variant="cards" :indicator="false" class="max-sm:flex-col">
        <flux:radio value="weekly" icon="chart-bar" label="Weekly" description="The weekly check-in that involves around general updates and progress." />
        <flux:radio value="monthly" icon="currency-dollar" label="Monthly" description="The monthly check-in that involves around finances mainly." />
    </flux:radio.group>

    @if ($type != '')
        @foreach ($this->measurables as $persona => $measurables)
            <flux:card>
                <flux:heading size="lg">
                    @if ($persona !== '')
                        {{ ucfirst($persona) }}'s progress
                    @else
                        Together's progress
                    @endif
                </flux:heading>
                <flux:separator class="my-4" />
                <div class="space-y-8">
                    @foreach ($measurables as $measurable)
                        <div class="flex items-top justify-between">
                            <div class="space-y-6 min-w-md">
                                <flux:heading size="lg">
                                    {{ $loop->iteration }}. {{ $measurable->name }}
                                </flux:heading>
                                @if ($measurable->goal)
                                    <flux:subheading>
                                        {{ $measurable->goal?->description }}
                                    </flux:subheading>
                                @endif
                                @if ($measurable->has_description)
                                    <flux:textarea
                                        label="Describe your progress"
                                        placeholder="E.g., What went well? What didn't go well? Any blockers?"
                                        wire:model.live="measurableData.{{ $measurable->id }}.description"
                                    />
                                @endif
                            </div>
                            <div class="space-y-6">
                                <flux:radio.group wire:model="measurableData.{{ $measurable->id }}.status" variant="segmented">
                                    <flux:radio value="failed" label="Failed" icon="x-mark" color="red"/>
                                    <flux:radio value="succeeded" label="Succeeded" icon="check" />
                                </flux:radio.group>
                                <div>
                                    @if ($measurable->do_measurement)
                                        @if ($measurable->unit == 'integer')
                                            <flux:input
                                                wire:model.live="measurableData.{{ $measurable->id }}.value"
                                                label="Value"
                                                type="number"
                                            />
                                        @endif
                                        @if ($measurable->unit == 'string')
                                            <flux:input
                                                wire:model.live="measurableData.{{ $measurable->id }}.value"
                                                label="Value"
                                                type="text"
                                            />
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </flux:card>
        @endforeach
    @endif

    <div class="flex items-center justify-end">
        <flux:button variant="primary" wire:click="save">
            Save Check-In
        </flux:button>
    </div>
</div>
