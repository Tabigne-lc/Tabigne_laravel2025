<?php

namespace App\Http\Controllers;

use App\Models\Usersinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    // Show the form where users can request a password reset link
    public function showRequestForm()
    {
        return view('forgot-password');
    }

    // Handle sending the password reset link to user's email
    public function sendResetLink(Request $request)
    {
        // Validate that the email field is provided, formatted as an email,
        // and exists in the usersinfo table
        $request->validate([
            'email' => 'required|email|exists:usersinfo,email',
        ]);

        // Generate a random 64-character token for password reset
        $token = Str::random(64);

        // Insert or update the password_resets table with the email, token,
        // and current timestamp
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        // Retrieve the user by email
        $user = Usersinfo::where('email', $request->email)->first();

        // Notify the user by sending a reset password email with the token
        $user->notify(new ResetPasswordNotification($token));

        // Redirect back with a success message indicating email sent
        return back()->with('success', 'We have emailed your password reset link!');
    }
}
