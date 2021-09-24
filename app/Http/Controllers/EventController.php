<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'invitation_text' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo adipisci reiciendis sequi porro doloremque quas! Illum, accusantium excepturi mollitia debitis praesentium nulla enim. Saepe, soluta corporis assumenda repellendus voluptas ullam?',
            'sms_text' => 'Du er herved invitert!',
            'sms_sender_name' => config('app.name')
        ];

        if (!$message = auth()->user()->events()->create($data)) {
            Log::critical($message);
            return back()->with('status', 'Noe gikk galt.');
        }

        return redirect()->route('dashboard')->with('status', 'Arrangementet ble opprettet.');
    }
}
