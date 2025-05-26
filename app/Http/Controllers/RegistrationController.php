<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Usersinfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyEmail;

class RegistrationController extends Controller
{
    // Handle user registration and save new user
    public function save(RegisterUserRequest $request)
    {
        $user = new Usersinfo;

        // Generate a UUID for the user ID
        $user->id = \Str::uuid();

        // Set user details from the registration request
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->sex = $request->sex;
        $user->birthday = $request->bod;
        $user->username = $request->username;
        $user->email = $request->email;

        // Hash the password before storing it
        $user->password = \Hash::make($request->password);

        // Generate a random token for email verification
        $user->verification_token = \Str::random(64);

        // Save the user record to the database
        $user->save();

        // Send email verification notification with the token
        $user->notify(new VerifyEmail($user->verification_token));

        // Show a registration success page and pass the user data
        return view('registration-success', ['user' => $user]);
    }

    // Verify user's email using the token from the verification link
    public function verifyEmail($token)
    {
        // Find the user with the matching verification token or fail
        $user = Usersinfo::where('verification_token', $token)->firstOrFail();
    
        // Set the email_verified_at timestamp to mark verified email
        $user->email_verified_at = now();

        // Clear the verification token so it can't be reused
        $user->verification_token = null;

        // Save changes to the user record
        $user->save();
    
        // Redirect to login page with a success message
        return redirect()->route('login')->with('success', 'Email verified! You can now log in.');
    }
}
