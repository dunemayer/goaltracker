<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Verify extends Component
{
    public $code = '013900';
    public $attempt = '';
    public $maxAttempts = 3;
    public $wrongAttempts = 0;
    public $cooldownUntil = 0; // timestamp
    public $cooldownSeconds = 60; // simple 60s cooldown after max attempts
    public $message = '';

    public function verify()
    {
        $now = time();

        // If we're in cooldown, inform how many seconds remain
        if ($this->cooldownUntil > $now) {
            $secondsLeft = $this->cooldownUntil - $now;
            $this->message = "Too many attempts. Try again in {$secondsLeft} seconds.";
            return;
        }

        // If previous cooldown expired, reset counters
        if ($this->cooldownUntil && $this->cooldownUntil <= $now) {
            $this->wrongAttempts = 0;
            $this->cooldownUntil = 0;
        }

        // Check the provided attempt against the code
        if ($this->attempt === $this->code) {
            $this->message = 'Verification successful!';
            $this->wrongAttempts = 0;
            $this->cooldownUntil = 0;
            // Mark the session as verified for two weeks
            $expiry = $now + (14 * 24 * 60 * 60); // 2 weeks
            session()->put('verification_valid_until', $expiry);
            // Regenerate the session id for safety
            session()->regenerate();
            // Redirect back to dashboard or intended route
            return redirect()->intended(route('dashboard'));
        } else {
            $this->wrongAttempts++;

            if ($this->wrongAttempts >= $this->maxAttempts) {
                $this->cooldownUntil = $now + $this->cooldownSeconds;
                $this->message = "Too many attempts. Try again in {$this->cooldownSeconds} seconds.";
            } else {
                $remaining = $this->maxAttempts - $this->wrongAttempts;
                $this->message = "Invalid verification code. {$remaining} attempt(s) left.";
            }
        }

        // For debugging/feedback show the attempt if verification failed
        if ($this->message === '') {
            $this->message = 'Attempted: ' . $this->attempt;
        }
    }

    public function render()
    {
        return view('livewire.verify');
    }
}
