<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;

class AccessControllService
{

    public static function userModel(string $name, Model $model): bool | Exception
    {
        if (!auth()->user()->{$name}->contains($model)) abort(403);

        return true;
    }
}
