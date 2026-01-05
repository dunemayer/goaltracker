<?php

use App\Livewire\Goals;
use App\Livewire\Dashboard;
use App\Livewire\CheckInForm;
use App\Livewire\CheckInIndex;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureSessionVerified;

// Verification page that renders your Livewire component
Route::view('/verify', 'verify')->name('verify');

// Protect dashboard and related routes with the session verification middleware
Route::middleware(EnsureSessionVerified::class)->group(function () {
	Route::get('/', Dashboard::class)->name('dashboard');
	Route::get('/goals', Goals::class)->name('goals');
	Route::get('/check-ins', CheckInIndex::class)->name('check-ins.index');
	Route::get('/check-ins/create', CheckInForm::class)->name('check-ins.create');
});
