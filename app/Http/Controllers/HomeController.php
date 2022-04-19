<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    
    public function __construct()
    {
        $this->middleware('auth');
    }
   

    // show the home page
    public function index()
    {
        return view('dashboard');
    }
}
