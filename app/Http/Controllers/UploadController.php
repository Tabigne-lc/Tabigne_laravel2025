<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    // Show the upload form if user is logged in
    public function create()
    {
        // Check if the user is logged in via session
        if (!session('user')) {
            // Redirect to login with error if not logged in
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to upload files.']);
        }

        // Render upload view
        return view('upload');
    }

    // Handle storing uploaded files
    public function store(Request $request)
    {
        // Retrieve user info from session
        $user = session('user');
        $userId = null;

        // Support user session stored as array or object
        if (is_array($user) && isset($user['id'])) {
            $userId = $user['id'];
        } elseif (is_object($user) && isset($user->id)) {
            $userId = $user->id;
        }
        
        // If user is not logged in, redirect to login with error
        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to upload files.']);
        }

        // Loop through all uploaded files
        foreach ($request->file('file') as $file) {
            // Generate a hashed name for the file
            $hashedName = $file->hashName();

            // Store file in 'public/uploads' directory
            $file->storeAs('uploads', $hashedName, 'public');

            // Create database record for the uploaded file
            Upload::create([
                'original_filename' => $file->getClientOriginalName(),
                'filename' => $hashedName,
                'type' => $file->getClientMimeType(),
                'uploaded_by' => $userId,
            ]);
        }

        // Redirect back to uploads page with success message
        return redirect()->route('upload.index')->with('success', 'Files uploaded successfully.');
    }

    // Display the list of uploads for the logged-in user, with filtering options
    public function index(Request $request)
    {
        $user = session('user');
    
        // Get user id from session (support both array and object)
        $userId = null;
        if (is_array($user) && isset($user['id'])) {
            $userId = $user['id'];
        } elseif (is_object($user) && isset($user->id)) {
            $userId = $user->id;
        }
    
        // Redirect if user is not logged in
        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to view your uploads.']);
        }
    
        // Start query filtering uploads by logged-in user
        $query = Upload::where('uploaded_by', $userId);
    
        // If filename filter provided, apply it with a LIKE search
        if ($request->filled('filename')) {
            $query->where('original_filename', 'like', '%' . $request->filename . '%');
        }
    
        // If file type filter provided, apply it
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
    
        // Paginate the results (10 per page) while preserving query strings
        $uploads = $query->paginate(10)->withQueryString();
    
        // Render view with the paginated uploads
        return view('my-uploads', compact('uploads'));
    }
    
    // Handle file download, only if the logged-in user owns the file
    public function download(Upload $upload)
    {
        $user = session('user');
        $userId = null;
        if (is_array($user) && isset($user['id'])) {
            $userId = $user['id'];
        } elseif (is_object($user) && isset($user->id)) {
            $userId = $user->id;
        }

        // Check user login
        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to download files.']);
        }

        // Check if user owns the file
        if ($upload->uploaded_by !== $userId) {
            abort(403); // Forbidden
        }

        // Build full file path
        $filePath = storage_path('app/public/uploads/' . $upload->filename);

        // Check if file exists
        if (!file_exists($filePath)) {
            return back()->withErrors(['error' => 'File not found.']);
        }

        // Return file as download response with original filename
        return response()->download($filePath, $upload->original_filename);
    }

    // Delete an uploaded file, only if owned by logged-in user
    public function destroy(Upload $upload)
    {
        $user = session('user');
        $userId = null;
        if (is_array($user) && isset($user['id'])) {
            $userId = $user['id'];
        } elseif (is_object($user) && isset($user->id)) {
            $userId = $user->id;
        }

        // Check user login
        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to delete files.']);
        }

        // Verify ownership of the upload
        if ($upload->uploaded_by !== $userId) {
            abort(403); // Forbidden
        }

        // Delete file from storage
        Storage::disk('public')->delete('uploads/' . $upload->filename);

        // Delete database record
        $upload->delete();

        // Redirect back with success message
        return back()->with('success', 'File deleted successfully.');
    }
}
