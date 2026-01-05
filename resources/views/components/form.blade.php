<div {{ $attributes->merge(['class' => 'space-y-6 mt-4']) }}>
    <div class="grid grid-cols-12 gap-6">
        {{ $slot }}
    </div>
</div>
