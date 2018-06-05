<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pediatricPhysicianController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:pediatric');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pediatric_physician');
    }
}
