<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvitationController extends Controller
{
    public function view(string $token)
    {
        $this->validateToken($token);

        $guest = Guest::where('invitation_token', $token)->first();
        $event = $guest->event()->first();

        $guest->update([
            'viewed' => 1
        ]);

        return view('invitations.invitation')
            ->with('guest', $guest)
            ->with('event', $event);
    }

    public function accept(string $token)
    {
        $this->validateToken($token);

        $guest = Guest::where('invitation_token', $token)->first();
        $event = $guest->event()->first();

        $guest->update([
            'attending' => 1,
            'responded' => 1
        ]);

        return redirect()
            ->route('invitation', $token)
            ->with('guest', $guest)
            ->with('event', $event)
            ->with('status', 'Invitasjon oppdatert.');
    }

    public function decline(string $token)
    {

        $this->validateToken($token);
        $guest = Guest::where('invitation_token', $token)->first();
        $event = $guest->event()->first();

        $guest->update([
            'responded' => 1,
            'attending' => 0
        ]);

        return redirect()
            ->route('invitation', $token)
            ->with('guest', $guest)
            ->with('event', $event)
            ->with('status', 'Invitasjon oppdatert.');
    }

    protected function validateToken($token)
    {
        $validator = Validator::make(['token' => $token], ['token' => 'required']);
        if ($validator->fails()) abort(404);
        return true;
    }
}
