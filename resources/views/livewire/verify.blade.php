<div class="mx-auto my-auto">
    @if($message)
        <div class="message">{{ $message }}</div>
    @endif
    <form wire:submit.prevent="verify" class="space-y-8">
        <div class="max-w-64 mx-auto space-y-2">
            <flux:heading size="lg" class="text-center">Verify session</flux:heading>
            <flux:text class="text-center">Please enter the application pin-code.</flux:text>
        </div>
        <div class="space-y-6">
            <flux:otp wire:model="attempt" length="6" submit="auto" class="mx-auto" />
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn">Verify</button>
        </div>
    </form>
</div>
