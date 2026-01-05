<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body class="min-h-screen bg-zinc-50 text-zinc-800 py-8">
    <div class="max-w-4xl p-6 rounded-lg mx-auto space-y-12">
        <nav class="mx-auto max-w-4xl">
            <div class="flex items-center justify-between">
                <x-brand />
                <div class="flex items-center space-x-1">
                    <flux:button variant="primary" icon="plus" href="{{ route('check-ins.create') }}">
                        {{ __('Check-In') }}
                    </flux:button>
                </div>
            </div>
            <div class="mt-6">
                <flux:navbar>
                    <flux:navbar.item :href="route('dashboard')" :current="request()->routeIs('dashboard')">Dashboard</flux:navbar.item>
                    <flux:navbar.item :href="route('goals')" :current="request()->routeIs('goals')">Goals</flux:navbar.item>
                    <flux:navbar.item :href="route('check-ins.index')" :current="request()->routeIs('check-ins.*')">Check-ins</flux:navbar.item>
                </flux:navbar>
            </div>
        </nav>
        <main class="mx-auto max-w-4xl pb-8 pt-4">
            {{ $slot }}
        </main>
        <footer class="mx-auto max-w-4xl">
            <div class="flex items-center justify-end">
                <flux:text class="italic text-right">
                    {!! inspiring_quote() !!}
                </flux:text>
            </div>
        </footer>
    </div>
    @fluxScripts
    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist
</body>
</html>
