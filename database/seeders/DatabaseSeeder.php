<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Anders',
            'email' => 'anders@tolvtemann.no',
            'password' => Hash::make('password'),
            'supadm' => 1
        ]);

        $i = 0;
        while ($i < 10) {
            $i++;
            $event = $user->events()->create([
                'name' => 'Event ' . $i,
                'invitation_text' => 'Lorem ipsum...',
                'sms_text' => 'Du har mottatt en invitasjon til Event ' . $i,
                'sms_sender_name' => 'Event ' . $i
            ]);
            $o = 0;
            while ($o < 25) {
                $o++;
                $guest = $event->guests()->create([
                    'phone' => $i . '456451' . $o,
                    'name' => 'Guest ' . $o . $i,
                ]);
            }
        }

        $event = $user->events()->create([
            'name' => 'The Main Event',
            'invitation_text' => 'Lorem ipsum...',
            'sms_text' => 'Du har mottatt en invitasjon til The Main Event',
            'sms_sender_name' => 'The Main Event'
        ]);
        $guest = $event->guests()->create([
            'phone' => '004745505898',
            'name' => 'Anders Iglebekk'
        ]);
        $guest = $event->guests()->create([
            'phone' => '004747831938',
            'name' => 'Monica Iglebekk'
        ]);
    }
}
