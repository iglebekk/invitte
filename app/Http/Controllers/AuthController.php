<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function password(string $token)
    {
        if (!$user = User::where('resetToken', $token)->first()) abort(404);

        return view('auth.password')->with('user', $user);
    }

    public function addPassword(string $token, Request $request)
    {
        if (!$user = User::where('resetToken', $token)->first()) abort(404);

        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required']
        ]);

        $validated['resetToken'] = Str::uuid();
        $validated['password'] = Hash::make($validated['Password']);
        $user->update($validated);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('status', 'Brukeren din er oppdatert. Velkommen!');
    }
}
