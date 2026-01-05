<div>
    <flux:modal name="edit-goal" :open="$showEditModal" wire:model="showEditModal">
        <form wire:submit="saveGoal" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Edit Goal') }}</flux:heading>
            </div>

            <flux:input wire:model="editTitle" label="{{ __('Title') }}" />

            <flux:editor wire:model="editDescription" label="{{ __('Description') }}" />

            @if (count($measurables) > 0)
                <div>
                    <flux:heading size="sm" class="mb-3">{{ __('Measurables') }}</flux:heading>
                    <div class="space-y-3">
                        @foreach ($measurables as $index => $measurable)
                            <flux:input
                                wire:model="measurables.{{ $index }}.name"
                                label="{{ __('Measurable') }} {{ $index + 1 }}"
                            />
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="flex gap-2 justify-end">
                <flux:button type="button" wire:click="closeEditModal" variant="ghost">
                    {{ __('Cancel') }}
                </flux:button>
                <flux:button type="submit" variant="primary">
                    {{ __('Save') }}
                </flux:button>
            </div>
        </form>
    </flux:modal>

    @foreach ($this->goals as $persona => $goals)
        <flux:card class="mb-6">
            <flux:heading size="lg">
                {{ $persona }}
            </flux:heading>
            <flux:separator class="my-4" />
            <div class="space-y-6">
                @foreach ($goals as $goal)
                    <div class="flex items-center justify-between">
                        <div class="space-y-6 min-w-md">
                            <flux:heading size="lg">
                                {{ $loop->iteration }}. {{ $goal->title }}
                            </flux:heading>
                            @if ($goal->description)
                                <flux:subheading>
                                    {!! $goal->description !!}
                                </flux:subheading>
                            @else
                                <flux:subheading class="italic text-zinc-500">
                                    {{ __('No description provided.') }}
                                </flux:subheading>
                            @endif
                        </div>
                        <div class="space-y-6">
                            <flux:button wire:click="editGoal({{ $goal->id }})" icon="pencil" size="sm">
                                {{ __('Edit') }}
                            </flux:button>
                        </div>
                    </div>
                @endforeach
            </div>
        </flux:card>
    @endforeach
</div>
