<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usersinfo;
class AuthController extends Controller
{
    //

    public function login(LoginRequest $request)
    {
        $user = Usersinfo::where('username', $request->username)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            if (is_null($user->email_verified_at)) {
                return back()->withErrors([
                    'email' => 'Please verify your email before logging in.',
                ])->withInput();
            }
            session(['user' => $user, 'user_id' => $user->id]);
            return redirect()->route('dashboard');
        }
    
        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ]);
    }

    public function logout(Request $request)
{
    $request->session()->forget('user');              // Remove the user session
    $request->session()->invalidate();                // Invalidate the session
    $request->session()->regenerateToken();           // Regenerate CSRF token for security

    return redirect()->route('login')->with('status', 'You have been logged out.');
}

public function verifyEmail($token)
{
    $user = Usersinfo::where('verification_token', $token)->firstOrFail();

    $user->email_verified_at = now();
    $user->verification_token = null;
    $user->save();

    return redirect()->route('login')->with('success', 'Email verified! You can now log in.');
}

}