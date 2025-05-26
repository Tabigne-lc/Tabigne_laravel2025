<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usersinfo;
use App\Http\Requests\UpdatePasswordRequest;

class PasswordController extends Controller
{
    //

    // Show the form for editing the user's password
    public function edit()
    {
        return view('edit-password');
    }

    // Handle the password update request
    public function update(UpdatePasswordRequest $request)
    {
        // Retrieve the currently logged-in user from the session
        $user = session('user');

        // Check if user exists and if the old password provided matches the stored password hash
        if (!$user || !Hash::check($request->old_password, $user->password)) {
            // If old password is incorrect, redirect back with an error message
            return back()->withErrors(['old_password' => 'Old password is incorrect.']);
        }

        // Hash the new password and update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirect back with a success message confirming the password update
        return back()->with('success', 'Password updated successfully!');
    }
}
