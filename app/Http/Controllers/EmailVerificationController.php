<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Usersinfo;
use App\Notifications\EmailVerificationNotification;

class EmailVerificationController extends Controller
{
    // Show the form where users can request a verification email
    public function showVerificationForm()
    {
        return view('verify-request');
    }

    // Handle sending the verification email
    public function sendVerificationEmail(Request $request)
    {
        // Validate that the email is provided, is a valid email, and exists in usersinfo table
        $request->validate([
            'email' => 'required|email|exists:usersinfo,email',
        ]);

        // Retrieve the user record by email
        $user = Usersinfo::where('email', $request->email)->first();

        // Check if email is already verified; if yes, inform the user
        if ($user->email_verified_at) {
            return back()->with('success', 'Your email is already verified.');
        }

        // Generate a new random verification token
        $user->verification_token = Str::random(60);
        $user->save();

        // Send notification email with the verification token
        $user->notify(new EmailVerificationNotification($user->verification_token));

        // Inform user that the verification email has been sent
        return back()->with('success', 'Verification email sent! Please check your inbox.');
    }

    // Verify the token when user clicks the verification link
    public function verifyToken($token)
    {
        // Find user by verification token or fail if not found
        $user = Usersinfo::where('verification_token', $token)->firstOrFail();

        // Mark email as verified by setting the current timestamp
        $user->email_verified_at = now();

        // Remove the token to prevent reuse
        $user->verification_token = null;

        // Save changes
        $user->save();

        // Redirect to login with success message
        return redirect()->route('login')->with('success', 'Email verified successfully!');
    }
}
