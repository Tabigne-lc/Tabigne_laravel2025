<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usersinfo;

class UserController extends Controller
{
    // Display list of users with optional filtering
    public function index(Request $request)
    {
        // Get current logged-in user info from session
        $currentUserId = session('user');
        $currentUser = Usersinfo::find(session('user_id'));

        // Only allow access if user exists and is Admin
        if (!$currentUser || $currentUser->user_type !== 'Admin') {
            abort(403, 'Access denied');
        }

        // Start query builder for Usersinfo model
        $query = Usersinfo::query();

        // Filter by name if provided (searches both first and last names)
        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->name}%")
                  ->orWhere('last_name', 'like', "%{$request->name}%");
            });
        }

        // Filter by email if provided
        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        // Paginate results, 10 per page, and preserve query strings
        $users = $query->paginate(10)->withQueryString();

        // Return user list view with the users data
        return view('user-list', compact('users'));
    }

    // Delete a user by ID (admin only)
    public function destroy($id)
    {
        // Get current logged-in user info from session
        $currentUserId = session('user');
        $currentUser = Usersinfo::find(session('user_id'));

        // Only allow admin to delete users
        if (!$currentUser || $currentUser->user_type !== 'Admin') {
            abort(403, 'Access denied');
        }

        // Prevent admin from deleting their own account
        if ($currentUser->id == $id) {
            return back()->withErrors(['delete' => 'You cannot delete your own account.']);
        }

        // Find the user to delete
        $user = Usersinfo::find($id);

        // Delete user if exists
        if ($user) {
            $user->delete();
            return back()->with('success', 'User deleted successfully.');
        }

        // Return error if user not found
        return back()->withErrors(['delete' => 'User not found.']);
    }
}
