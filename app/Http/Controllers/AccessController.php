<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessControllService;
use App\Mail\UserWelcome;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AccessController extends Controller
{
    public function view(Event $event)
    {
        AccessControllService::userModel('events', $event);

        return view('accesses.view')
            ->with('event', $event)
            ->with('users', $event->users()->get());
    }

    public function store(Event $event, Request $request)
    {
        AccessControllService::userModel('events', $event);

        $validated = $request->validate([
            'email' => ['required', 'email:rfc,dns']
        ]);

        if (!$user = User::where('email', $request->email)->first()) {
            $password = Str::random(40);
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($password),
                'resetToken' => Str::uuid()
            ]);
            Mail::to($user)->send(new UserWelcome($user));
        }


        $event->users()->attach($user->id);

        return redirect()->route('accesses', $event->id);
    }
}
