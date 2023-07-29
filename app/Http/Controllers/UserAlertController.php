<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAlert;

class UserAlertController extends Controller
{
    public function store(Request $request)
    {
        // Store the user alert in the database for the current user
        UserAlert::create(['user_id' => auth()->id()]);
    }
}
