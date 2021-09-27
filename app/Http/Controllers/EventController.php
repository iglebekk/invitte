<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessControllService;
use App\Http\Services\FikoService;
use App\Models\Event;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'invitation_text' => 'Du er invitert til ' . $request->name . '. <br /> Gi beskjed om du har anledning til å være med.',
            'sms_text' => 'Du er herved invitert!',
            'sms_sender_name' => config('app.name')
        ];

        if (!$message = auth()->user()->events()->create($data)) {
            Log::critical($message);
            return back()->with('status', 'Noe gikk galt.');
        }

        return redirect()->route('dashboard')->with('status', 'Arrangementet ble opprettet.');
    }

    public function view(Event $event): View | Exception
    {
        AccessControllService::userModel('events', $event);

        return view('event')
            ->with('event', $event)
            ->with('guests', $event->guests()->orderByDesc('id')->paginate());
    }

    public function sendInvitation(Event $event): RedirectResponse | Exception
    {
        AccessControllService::userModel('events', $event);

        $data['sender'] = $event->sms_sender_name;
        $data['message'] = $event->sms_text;

        $recipients = $event->guests()->where('sms_invitation', 0)->where('responded', 0)->get();

        foreach ($recipients as $recipient) {
            $data['recipient'] = $recipient->phone;
            $data['message'] = $event->sms_text . " Følg lenken for å se invitasjonen: " . config('app.url') . '/invitation/' . $recipient->invitation_token;
            if (!FikoService::send($data)) abort(500);

            $recipient->update([
                'sms_invitation' => 1
            ]);
        }

        return redirect()
            ->route('event', $event)
            ->with('status', 'Invitasjoner sendt.');
    }

    public function sendReminder(Event $event): RedirectResponse | Exception
    {
        AccessControllService::userModel('events', $event);

        $data['sender'] = $event->sms_sender_name;
        $data['message'] = $event->sms_text;

        $recipients = $event->guests()->where('sms_invitation', 1)->where('responded', 0)->get();

        foreach ($recipients as $recipient) {
            $data['recipient'] = $recipient->phone;
            $data['message'] = 'Dette er en påminnelse om invitasjon.' . " Følg lenken for å se invitasjonen: " . config('app.url') . '/invitation/' . $recipient->invitation_token;
            if (!FikoService::send($data)) abort(500);

            $recipient->update([
                'sms_reminder' => 1
            ]);
        }

        return redirect()
            ->route('event', $event)
            ->with('status', 'Påminnelser sendt.');
    }

    public function settings(Event $event)
    {
        return view('settings')
            ->with('event', $event);
    }

    public function settingsStore(Event $event, Request $request)
    {
        AccessControllService::userModel('events', $event);

        $validated = $request->validate([
            'sms_sender_name' => 'string',
            'sms_text' => 'string',
            'invitation_text' => 'string'
        ]);

        $event->update($validated);

        return redirect()
            ->route('event.settings', $event)
            ->with('status', 'Innstillingene er lagret!');
    }
}
