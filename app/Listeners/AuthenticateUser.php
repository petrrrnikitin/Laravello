<?php

namespace App\Listeners;


use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $guard = Auth::guard(config('sanctum.guard', 'web'));

        $guard->login($event->user);
    }
}
