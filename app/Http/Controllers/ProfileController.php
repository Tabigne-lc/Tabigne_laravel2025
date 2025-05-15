<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usersinfo;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['session' => 'You must be logged in.']);
        }
    
        return view('edit-profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Usersinfo::find(session('user')->id);

        if ($user) {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->save();
    
            session(['user' => $user]);
    
            return back()->with('success', 'Profile updated successfully!');
        }
    
        return back()->withErrors(['user' => 'User not found.']);
    }
}