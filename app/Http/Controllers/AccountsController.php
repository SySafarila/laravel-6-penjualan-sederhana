<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('password.confirm')->only('index');
    }

    public function index()
    {
        // return Auth::user();
        return view('account.index');
    }

    public function updateCredentials(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('account.index')->with('status', 'Account updated !');
    }
}
