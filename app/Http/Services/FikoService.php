<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class FikoService
{

    protected static $uri = 'http://api.fiko.no/?api=smsOut';
    protected static $token = 'eaea01bbcb7a37604292b87d42b8f774';

    /**
     * @param $data['recipient'] Phone number of recipient
     */

    public static function send(array $data): bool
    {
        $url = self::$uri . '&token=' . self::$token . '&client=Invitte&sender=' . $data['sender'] . '&recipient=' . $data['recipient'] . '&message=' . $data['message'];

        $response = Http::get($url);

        if ($response->failed()) {
            Log::critical($response->body());
            return false;
        }
        return true;
    }
}
