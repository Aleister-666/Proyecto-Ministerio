<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Proporciona la vista para el Home
     */
    public function index()
    {
        return view('home/index');
    }
}
