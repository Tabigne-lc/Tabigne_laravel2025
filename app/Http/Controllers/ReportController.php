<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usersinfo;
use App\Models\Upload;
use DB;

class ReportController extends Controller
{
    // Display various reports about users and uploads
    public function index()
    {
        // Get counts of uploads grouped by their file type
        $fileTypes = Upload::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get();

        // Get monthly user registration totals, formatted as "YYYY-MM"
        $userRegistrations = Usersinfo::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Get counts of users grouped by their birth year
        $birthYears = Usersinfo::selectRaw('YEAR(birthday) as year, count(*) as count')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        // Get monthly upload totals, formatted as "YYYY-MM"
        $fileUploads = Upload::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Pass all collected data to the 'reports' view for display
        return view('reports', compact('fileTypes', 'userRegistrations', 'birthYears', 'fileUploads'));
    }
}
