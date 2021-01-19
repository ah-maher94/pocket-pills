<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User\UserInfo;
use App\Models\productinfo;

class UserCartController extends Controller
{

    // public function __construct(){
    //     $this->middleware(["auth"]);
    // }


    public function getCartProducts(){
        return DB::table('userCart')
        ->join('userInfo', 'userinfo.userid', 'userCart.userid')
        ->join('productInfo', 'productInfo.productCode', 'userCart.productCode')
        ->select('userCart.productQuantity', 'productInfo.*')
        ->where('userCart.userId', '=', 8)
        ->get();
    }

    public function addProduct(Request $request){
        $prouctCode = $request->productId;
        $branchId = $request->branchId;
        $request->user()->cart()->create([
            'productQuantity'=>$request->productQuantity,
            'branchId'=>$branchId,
        ]);
    }

    public function updateQuantity(Request $request){
        $prouctCode = $request->productId;
        DB::table('userCart')
        ->where('userId', 8)
        ->where('productCode', '=', $prouctCode)
        ->update(array('productQuantity'=>$request->productQuantity));
    }

    public function deleteProduct(Request $request){
        $prouctCode = $request->productId;
        // $userId = auth()->user()->id;
        return DB::table('userCart')
        ->where('productCode', '=', $prouctCode)
        ->where('userId', '=', 8)
        ->delete();
    }



}
