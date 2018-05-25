<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clinic;

class PagesController extends Controller
{
    //return static pages
    public function getIndex(){

        return view('pages.welcome',compact('clinics'));
    }
}
