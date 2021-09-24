<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function dashboard()
    {

        return view('dashboard')->with('events', auth()->user()->events()->withCount('guests')->OrderByDesc('id')->get());
    }
}
