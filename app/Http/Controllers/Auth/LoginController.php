<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\UserInfo;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware(["guest"]);
    }

    public function loggedIn(Request $request){
        $this->validate($request,[
            "userEmail"=>"required|email",
            "userPassword"=>"required",
        ]);

        if (Auth::guard('userInfo')->attempt(['email' => $request->userEmail, 'password' => $request->userPassword])) {
            $details = Auth::guard('userInfo')->user();
            return $details;
        } else {
            return 'auth fail';
        }

        // if(!Auth::guard('userInfo')->attempt($request->only("userEmail", "userPassword"))){
        //     return back()->with("status", "Invalid Login Details");
        // }

        // return "success";
    }
    
}
