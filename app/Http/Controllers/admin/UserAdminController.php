<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id')->get();

        return view('admin.users.index', compact('users'));
    }

    public function toggle(User $user)
    {
        $user->update(['is_blocked' => !$user->is_blocked]);

        return redirect()->route('admin.users.index');
    }
}
