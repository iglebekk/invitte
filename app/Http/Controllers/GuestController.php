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

        if (strlen($request->phone) == 8) {
            $validated['phone'] = 0047 . $request->phone;
        }

        $event->guests()->create($validated);

        return redirect()->route('event', $event)->with('status', 'Ny gjest lagret.');
    }
}
