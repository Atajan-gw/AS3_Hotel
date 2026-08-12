<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        if (!$request->session()->get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string', 'min:3', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);

        $credentials['username'] = trim($credentials['username']);

        if ($credentials['username'] === 'admin' && $credentials['password'] === '12345678') {
            $request->session()->put('admin_logged_in', true);
            $request->session()->put('admin_username', 'admin');

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'Invalid admin credentials.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_username']);
        Session::flush();

        return redirect()->route('admin.login');
    }
}
