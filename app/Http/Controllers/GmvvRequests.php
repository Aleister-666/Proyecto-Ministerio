<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GmvvRequests extends Controller
{
    public function new()
    {   
        $user = auth()->user();
        return view('gmvv_requests/new', compact('user'));
    }

    public function create()
    {
        
    }
}
