<x-grid-container cols="12">
    <div class="col-span-12">
        <flux:card class="max-h-[300px] overflow-y-scroll">
            <div class="flex items-center justify-between">
                <flux:heading size="lg">
                    Goals together
                </flux:heading>
            </div>
            <flux:separator class="my-4" />
            <div class="space-y-2">
                @foreach($this->goals->where('persona_id', null) as $goal)
                    <div class="flex items-center justify-between">
                        <flux:heading size="md">
                            {{ $goal->title }}
                        </flux:heading>
                        @if ($goal->persona)
                            <flux:badge variant="info" class="mb-2" color="{{ $goal->persona->id == 1 ? 'blue' : 'pink' }}">
                                {{ $goal->persona->name }}
                            </flux:badge>
                        @endif
                    </div>
                    @if($goal->description)
                        <flux:subheading>
                            {{ $goal->description }}
                        </flux:subheading>
                    @endif
                    @if (! $loop->last)
                        <flux:separator class="my-4" />
                    @endif
                @endforeach
            </div>
        </flux:card>
    </div>
    <div class="col-span-6">
        <flux:card class="max-h-[300px] overflow-y-scroll">
            <div class="flex items-center justify-between">
                <flux:heading size="lg">
                    Goals - Huub Duinmeijer
                </flux:heading>
            </div>
            <flux:separator class="my-4" />
            <div class="space-y-2">
                @foreach($this->goals->where('persona_id', 1) as $goal)
                    <div class="flex items-center justify-between">
                        <flux:heading size="md">
                            {{ $goal->title }}
                        </flux:heading>
                    </div>
                    @if($goal->description)
                        <flux:subheading>
                            {{ $goal->description }}
                        </flux:subheading>
                    @endif
                    @if (! $loop->last)
                        <flux:separator class="my-4" />
                    @endif
                @endforeach
            </div>
        </flux:card>
    </div>
    <div class="col-span-6">
        <flux:card class="max-h-[300px] overflow-y-scroll">
            <div class="flex items-center justify-between">
                <flux:heading size="lg">
                    Goals - Thays Araujo
                </flux:heading>
            </div>
            <flux:separator class="my-4" />
            <div class="space-y-2">
                @foreach($this->goals->where('persona_id', 2) as $goal)
                    <div class="flex items-center justify-between">
                        <flux:heading size="md">
                            {{ $goal->title }}
                        </flux:heading>
                    </div>
                    @if($goal->description)
                        <flux:subheading>
                            {{ $goal->description }}
                        </flux:subheading>
                    @endif
                    @if (! $loop->last)
                        <flux:separator class="my-4" />
                    @endif
                @endforeach
            </div>
        </flux:card>
    </div>
</x-grid-container>
