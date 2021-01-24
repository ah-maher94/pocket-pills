<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User\UserInfo;
use App\Models\cart;

use App\Models\productinfo;

class UserCartController extends Controller
{

    // public function __construct(){
    //     $this->middleware(["auth"]);
    // }

    public function getCartProducts(Request $request){
        // dd($request->userId);
        return DB::table('userCart')
        ->join('userInfo', 'userinfo.userid', 'userCart.userid')
        ->join('productInfo', 'productInfo.productCode', 'userCart.productCode')
        ->select('userCart.productQuantity', 'productInfo.*')
        ->where('userCart.userId', '=', $request->userId)
        ->get();
    }

    //added
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getProductList(Request $request){
        // dd('sayed');
        return DB::table('userCart')
        ->join('userInfo', 'userinfo.userid', 'userCart.userid')
        ->join('productInfo', 'productInfo.productCode', 'userCart.productCode')
        ->select('productInfo.productCode')
        ->where('userCart.userId', '=', $request['userId'])
        ->get();
    }
    //edited
    public function addProduct(Request $request){
        // $prouctCode = $request->productId;
        // $branchId = $request->branchId;
        // $request->user()->cart()->create([
        //     'productQuantity'=>$request->productQuantity,
        //     'branchId'=>$branchId,
        // ]);
        // dd($request);
        cart::create([
            'userId'=>$request['userId'],
            'productCode'=>$request['productCode'],
            'productQuantity'=>$request['productQuantity'],
            'branchId'=>$request['branchId'],
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
        $userId = $request->userId;
        // dd($userId);
        // $userId = auth()->user()->id;
        return DB::table('userCart')
        ->where('productCode', '=', $prouctCode)
        ->where('userId', '=', $userId)
        ->delete();
    }


    public function clearCart(Request $request){
        $userId = $request->userId;
        // dd($userId );
        $userProducts = DB::table('userCart')
        ->where('userId', '=', $userId)
        ->get();

        $userProductsArray = json_decode($userProducts, true);

        // dd($userProductsArray[0]['userId']);

        DB::beginTransaction();
        try{
        DB::table('userInv')->insert([
            "invDate"=>now(),
            "userId"=>$userProductsArray[0]['userId'],
        ]);

        // get last inserted id
        $invoideId = $id = DB::getPdo()->lastInsertId();

        for($temp=0; $temp<count($userProductsArray); $temp++){

            DB::table('invoiceDetails')->insert([
                "invNo"=>$invoideId,
                "productCode"=>$userProductsArray[$temp]['productCode'],
                "productQuantity"=>$userProductsArray[$temp]['productQuantity'],
                "branchId"=>$userProductsArray[$temp]['branchId']
            ]);
        }

        DB::table('userCart')
        ->where('userId', '=', $userId)
        ->delete();
        DB::commit();

        return response()->json(['message' => 'success'], 200);

    }catch (\Exception $e) {
            DB::rollback();
            echo ($e);
            return response()->json(['error' => 'failed'], 409); 
        }
    }


}
