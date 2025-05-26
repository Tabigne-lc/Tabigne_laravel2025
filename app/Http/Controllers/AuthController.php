<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usersinfo;

class AuthController extends Controller
{
    //

    // Handle user login
    public function login(LoginRequest $request)
    {
        // Find user by username
        $user = Usersinfo::where('username', $request->username)->first();
    
        // Check if user exists and password matches
        if ($user && Hash::check($request->password, $user->password)) {
            // Check if user's email is verified
            if (is_null($user->email_verified_at)) {
                // Redirect back with error if email not verified
                return back()->withErrors([
                    'email' => 'Please verify your email before logging in.',
                ])->withInput();
            }
            // Store user info and user id in session
            session(['user' => $user, 'user_id' => $user->id]);
            // Redirect to dashboard after successful login
            return redirect()->route('dashboard');
        }
    
        // Redirect back with error if login fails
        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ]);
    }

    // Handle user logout
    public function logout(Request $request)
    {
        $request->session()->forget('user');              // Remove the user session data
        $request->session()->invalidate();                // Invalidate the entire session
        $request->session()->regenerateToken();           // Regenerate CSRF token to prevent CSRF attacks

        // Redirect to login page with a logout confirmation message
        return redirect()->route('login')->with('status', 'You have been logged out.');
    }

    // Verify user email with token
    public function verifyEmail($token)
    {
        // Find user by verification token or fail if not found
        $user = Usersinfo::where('verification_token', $token)->firstOrFail();

        // Mark email as verified by setting timestamp
        $user->email_verified_at = now();
        // Clear the verification token to prevent reuse
        $user->verification_token = null;
        // Save changes to the database
        $user->save();

        // Redirect to login with success message
        return redirect()->route('login')->with('success', 'Email verified! You can now log in.');
    }

}
