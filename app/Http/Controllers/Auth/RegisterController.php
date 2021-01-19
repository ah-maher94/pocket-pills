<?php

namespace App\Http\Controllers\Auth;

use App\Models\User\UserInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware(["guest"]);
    }

    public function store(Request $request){

        // validate form
        $this->validate($request, [
            "userName" => "required|min:5|max:255",
            "userEmail" => "required|email|unique:userInfo,email",
            "userPassword" => "required",
            "userPhone" => "required"
        ]);

        // dd($request);

        DB::beginTransaction();
        try{
            // save to db
            DB::table('userInfo')->insert([
                "userName"=>$request->userName,
                "email"=>$request->userEmail,
                "password"=>Hash::make($request->userPassword),
                // "userPassword"=>$request->userPassword,
                "userPhone"=>$request->userPhone,
            ]);

            
            // get last inserted id
            $userId = $id = DB::getPdo()->lastInsertId();
            
            // insert user locations
            $locations=$request->userLocation;
            $locationsArray = array();
            foreach($locations as $location)
            {
                if(!empty($location))
                {
                $locationsArray[] =[
                        'userId' => $userId,
                        'userLocation' => $location,
                        ];                 
                }
            }
            DB::table('userLocation')->insert($locationsArray);

            DB::commit();

            // log user in after registration
            auth()->attempt($request->only('email','password'));
            // return redirect()->route('home');
            return response()->json(['message' => 'success'], 200);

        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'exist'], 409); 
            // return back();

        }
    
    }
    
}
