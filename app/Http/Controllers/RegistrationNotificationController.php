<?php

namespace App\Http\Controllers;

use App\Notifications\RegistrationNotification;
use Illuminate\Http\Request;

class RegistrationNotificationController extends Controller
{
    //

    public function store(Request $request)
    {
        
        $notification = new RegistrationNotification();
    }
}