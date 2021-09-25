<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'sms_invitation', 'sms_reminder', 'attending', 'responded', 'viewed', 'invitation_token'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
