<?php

namespace App\Http\Services;

class FikoService
{

    protected static $url = 'http://api.fiko.no/?api=smsOut';
    protected static $token = 'eaea01bbcb7a37604292b87d42b8f774';
    protected static $client = 'Tolvte Mann';
    protected static $sender = '';
    protected static $recipient = '';
    protected static $message = '';

    public static function send(array $data)
    {
        //
    }
}
