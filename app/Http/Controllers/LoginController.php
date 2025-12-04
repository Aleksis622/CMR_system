<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRecord;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
     public function show()
    {
        return view('login'); 
    }
public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = UserRecord::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Invalid email or password.');
    }

    // store session
    session([
        'user_name' => $user->name,
        'user_email' => $user->email,
    ]);

    return redirect()->route('dashboard');
}
}