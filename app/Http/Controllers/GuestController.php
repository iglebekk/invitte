<?php

namespace App\Http\Controllers;

use App\Http\Services\AccessControllService;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class GuestController extends Controller
{
    public function create(Event $event, Request $request)
    {
        AccessControllService::userModel('events', $event);

        $validated = $request->validate([
            'name' => ['required'],
            'phone' => ['required', 'integer', 'digits_between:8,12', Rule::unique('guests')->where(function ($query) use ($event) {
                return $query->where('event_id', $event->id);
            })]
        ]);

        $validated['phone'] = $this->validatePhone($request->phone);

        $event->guests()->create($validated);

        return redirect()->route('event', $event)->with('status', 'Ny gjest lagret.');
    }

    public function massCreate(Event $event, Request $request)
    {
        AccessControllService::userModel('events', $event);

        $validated = $request->validate([
            'data' => ['required']
        ]);

        $lines = explode(PHP_EOL, $validated['data']);

        foreach ($lines as $line) {
            $profile = explode(',', $line);

            $event->guests()->create([
                'name' => $profile[0],
                'phone' => $this->validatePhone(str_replace(' ', '', str_replace("\r", '', $profile[1])))
            ]);
        }
        return redirect()->route('event', $event)->with('status', 'Nye gjester lagret.');
    }

    private function validatePhone(string $phone)
    {
        if (strlen($phone) == 8) {
            $phone = '0047' . $phone;
        }
        return $phone;
    }
}
