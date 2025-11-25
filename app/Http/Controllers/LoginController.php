<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRecord;

class LoginController extends Controller
{

    public function show()
    {
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required', bcrypt($request->password),
        ]);

        if (UserRecord::where('password', $request->password)->exists()) {
            return back()->with('error', 'This password is already used by another user.');
        }

       // simple session checks 
        session([
            'user_name' => $request->name,
            'user_email' => $request->email,
        ]);

        return redirect('/dashboard'); 
    }
}
