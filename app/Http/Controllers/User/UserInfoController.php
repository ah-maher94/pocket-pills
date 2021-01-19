<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User\UserInfo;

class UserInfoController extends Controller
{

    public function getAllUsers(){
        return DB::table('userinfo')
        ->join('userlocation', 'userinfo.userid', 'userlocation.userid')
        ->select('userinfo.*', 'userlocation.userlocation')
        ->get();
    }


    public function getUser(Request $request){
        // dd($request->id);
        $userId = $request->id;
        return DB::table('userinfo')
        ->join('userlocation', 'userinfo.userid', '=', 'userlocation.userid')
        ->select('userinfo.*', 'userlocation.userlocation')
        ->where('userinfo.userid', '=', $userId)
        ->get();
    }


    public function updateUser(Request $request){

        // dd($request->userlocation);
        $userId = $request->id;
        DB::table('userinfo')
        ->where('userid', $userId)
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('userName'=>$request->userName, 'userEmail'=>$request->userEmail, 'userPassword'=>$request->userPassword,
         'userPhone'=>$request->userPhone));

        //  DB::table('userLocation')
        // ->where('userid', $userId)
        // ->update(array('userLocation'=>$request->userlocation));

         return DB::table('userinfo')
         ->join('userlocation', 'userinfo.userid', '=', 'userlocation.userid')
         ->select('userinfo.*', 'userlocation.userlocation')
         ->where('userinfo.userid', '=', $userId)
         ->get();
    }

    public function deleteUser(Request $request){
        // dd($request->id);
        $userId = $request->id;
        return DB::table('userInfo')->where('userId', '=', $userId)->delete();
    }



}
