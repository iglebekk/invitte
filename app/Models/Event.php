<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'invitation_text', 'sms_text', 'sms_sender_name'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
}
