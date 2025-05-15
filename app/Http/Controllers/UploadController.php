<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function create()
    {
        // Check if the user is logged in
        if (!session('user')) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to upload files.']);
        }

        return view('upload');
    }

    public function store(Request $request)
    {
        $user = session('user');
        $userId = null;
        if (is_array($user) && isset($user['id'])) {
            $userId = $user['id'];
        } elseif (is_object($user) && isset($user->id)) {
            $userId = $user->id;
        }
        
        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to upload files.']);
        }

        foreach ($request->file('file') as $file) {
            $hashedName = $file->hashName();
            $file->storeAs('uploads', $hashedName, 'public');

            Upload::create([
                'original_filename' => $file->getClientOriginalName(),
                'filename' => $hashedName,
                'type' => $file->getClientMimeType(),
                'uploaded_by' => $userId,
            ]);
        }

        return redirect()->route('upload.index')->with('success', 'Files uploaded successfully.');
    }

    public function index(Request $request)
    {
        $user = session('user');
    
        $userId = null;
        if (is_array($user) && isset($user['id'])) {
            $userId = $user['id'];
        } elseif (is_object($user) && isset($user->id)) {
            $userId = $user->id;
        }
    
        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to view your uploads.']);
        }
    
        $query = Upload::where('uploaded_by', $userId);
    
        if ($request->filled('filename')) {
            $query->where('original_filename', 'like', '%' . $request->filename . '%');
        }
    
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
    
        $uploads = $query->paginate(10)->withQueryString();
    
        return view('my-uploads', compact('uploads'));
    }
    

    public function download(Upload $upload)
{
    $user = session('user');
    $userId = null;
    if (is_array($user) && isset($user['id'])) {
        $userId = $user['id'];
    } elseif (is_object($user) && isset($user->id)) {
        $userId = $user->id;
    }

    if (!$userId) {
        return redirect()->route('login')->withErrors(['error' => 'You must be logged in to download files.']);
    }

    if ($upload->uploaded_by !== $userId) {
        abort(403);
    }

    $filePath = storage_path('app/public/uploads/' . $upload->filename);

    if (!file_exists($filePath)) {
        return back()->withErrors(['error' => 'File not found.']);
    }

    return response()->download($filePath, $upload->original_filename);
}
    
public function destroy(Upload $upload)
{
    $user = session('user');
    $userId = null;
    if (is_array($user) && isset($user['id'])) {
        $userId = $user['id'];
    } elseif (is_object($user) && isset($user->id)) {
        $userId = $user->id;
    }

    if (!$userId) {
        return redirect()->route('login')->withErrors(['error' => 'You must be logged in to delete files.']);
    }

    if ($upload->uploaded_by !== $userId) {
        abort(403);
    }

    Storage::disk('public')->delete('uploads/' . $upload->filename);
    $upload->delete();

    return back()->with('success', 'File deleted successfully.');
}

}
