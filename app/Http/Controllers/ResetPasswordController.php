<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Usersinfo;
use App\Notifications\ResetForgottenPasswordNotification;

class ResetPasswordController extends Controller
{
    // Show the password reset form, passing the token to the view
    public function showResetForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    // Handle the password reset submission
    public function reset(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'email' => 'required|email|exists:usersinfo,email',
            'password' => 'required|min:8|confirmed',  // Password confirmation must match
            'token' => 'required'
        ]);

        // Verify the password reset token for the given email
        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        // If token is invalid or expired, return with error
        if (!$reset) {
            return back()->withErrors(['email' => 'Invalid or expired reset token.']);
        }

        // Find user and update password
        $user = Usersinfo::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Notify user of successful password reset
        $user->notify(new ResetForgottenPasswordNotification());

        // Delete the used password reset token from database
        DB::table('password_resets')->where('email', $request->email)->delete();

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Your password has been reset successfully!');
    }
}
