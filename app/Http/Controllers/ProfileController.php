<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usersinfo;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    // Show the form to edit user profile
    public function edit()
    {
        // Retrieve the logged-in user from the session
        $user = session('user');

        // If no user is logged in, redirect to login with an error message
        if (!$user) {
            return redirect()->route('login')->withErrors(['session' => 'You must be logged in.']);
        }
    
        // Load the edit-profile view, passing the user data
        return view('edit-profile', compact('user'));
    }

    // Handle the profile update form submission
    public function update(UpdateProfileRequest $request)
    {
        // Find the user record in the database by ID stored in session
        $user = Usersinfo::find(session('user')->id);

        if ($user) {
            // Update user fields from the request data
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->save();
    
            // Update the user object in session to reflect changes
            session(['user' => $user]);
    
            // Redirect back with a success message
            return back()->with('success', 'Profile updated successfully!');
        }
    
        // If user not found, redirect back with an error
        return back()->withErrors(['user' => 'User not found.']);
    }
}
