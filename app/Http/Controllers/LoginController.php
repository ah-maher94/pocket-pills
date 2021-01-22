<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\userinfo;

class LoginController extends Controller
{
    // public function __construct(){
    //     $this->middleware(["guest"]);
    // }

    // public function login(){
    //     return view('auth.login');
    // }

    public function loggedIn(Request $request){
        $this->validate($request,[
            "userEmail"=>"required|email",
            "userPassword"=>"required",
        ]);

        if(!auth()->attempt($request->only("userEmail", "userPassword"))){
            return back()->with("status", "Invalid Login Details");
        }

        return "success";
    }
    
}
