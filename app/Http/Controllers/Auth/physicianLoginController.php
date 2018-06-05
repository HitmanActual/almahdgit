<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class physicianLoginController extends Controller
{
    //
    /*public function __construct(){
        $this->middleware('guest:pediatric');
    }*/

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
        if(Auth::guard('pediatric')->attempt(['email'=>$request->email,'password'=>$request->password,'clinic_id'=>1],$request->remember)){
            //if susscess then redirect to the intended location
            return redirect()->intended(route('pediatric.dashboard'));
        }
        if(Auth::guard('orthopedic')->attempt(['email'=>$request->email,'password'=>$request->password,'clinic_id'=>2],$request->remember)){
            //if susscess then redirect to the intended location
            return redirect()->intended(route('orthopedic.dashboard'));
        }
    
        //if unsussessfull redirect back
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
