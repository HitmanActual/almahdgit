<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class physicianLoginController extends Controller
{
    //
    public function __construct(){
        $this->middleware('guest:doctor');
    }

    public function showLoginForm(){
        return view('auth.physician-login');
    }

    public function login(Request $request){
        //validate

        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);

        //attepmt to log the physician in based on clinic Id too
        if(Auth::guard('doctor')->attempt(['email'=>$request->email,'password'=>$request->password,'clinic_id'=>1],$request->remember)){
            //if susscess then redirect to the intended location
            return redirect()->intended(route('physician.dashboard'));
        }
        if(Auth::guard('doctor')->attempt(['email'=>$request->email,'password'=>$request->password,'clinic_id'=>6],$request->remember)){
            //if susscess then redirect to the intended location
            return redirect()->intended(route('physician_we.dashboard'));
        }
    
        //if unsussessfull redirect back
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
