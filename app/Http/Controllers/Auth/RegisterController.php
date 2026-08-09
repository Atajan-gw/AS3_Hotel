<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'name' => $data['username'],
            'username' => $data['username'],
            'email' => $data['username'] . '@hotel.local',
            'password' => $data['password'],
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended(route('hotels.index'));
    }
}
