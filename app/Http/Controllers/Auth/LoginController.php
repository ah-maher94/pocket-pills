<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            // dd($details['userRole']);
            $branchId = null;
            if($details['userRole']==="admin"){
                $branchId = DB::table('userinfo')
                ->join('branchInfo', 'userinfo.userid', '=', 'branchInfo.userid')
                ->select('branchInfo.branchId')
                ->where('userinfo.userid', '=', $details['userId'])
                ->get();
                // dd($branchId);
            }
            
            return response()->json(['details'=>$details, 'branchId'=>$branchId],200);
        } else {
            return 'auth fail';
        }

        // if(!Auth::guard('userInfo')->attempt($request->only("userEmail", "userPassword"))){
        //     return back()->with("status", "Invalid Login Details");
        // }

        // return "success";
    }
    
}
