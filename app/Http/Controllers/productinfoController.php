<?php

namespace App\Http\Controllers;

use App\Models\productinfo;
use App\Models\productimage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

// use App\Http\Controllers\Validator;
class productinfoController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products=productinfo::all();

        $products = DB::table('productinfo')
        ->join('productimages','productinfo.productCode','=','productimages.productCode')
        ->select('productimages.productImage','productinfo.*')
        ->get();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'productCode' => 'required',
            'productName' => 'required',
            'productPrice' => 'required',
            'productdescription' => 'required',
            'manufacturer' => 'required',
            'productImage' => 'required',
        ]);
        // // Check validation failure
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->messages()],400);
        }
    
        //insert new record in productinfo table
        productinfo::create([
            'productCode'=>$request['productCode'],
            'productName'=>$request['productName'],
            'productPrice'=>$request['productPrice'],
            'productdescription'=>$request['productdescription'],
            'manufacturer'=>$request['manufacturer']
        ]);
        
        //insert new record in productimage table
        productimage::create([
            'productCode'=>$request['productCode'],
            'productImage'=>$request['productImage']
        ]);

        return response()->json(['message'=>'Success'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productinfo  $productinfo
     * @return \Illuminate\Http\Response
     */
    public function show($productinfo)
    {
        $products = DB::table('productinfo')
        ->join('productimages','productinfo.productCode','=','productimages.productCode')
        ->select('productimages.productImage','productinfo.*')
        ->where('productinfo.productCode','=',$productinfo)
        ->get();
        return $products;
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productinfo  $productinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$productinfo)
    {
        // validate data that will be updated
        $validator = Validator::make($request->all(), [
            'productCode' => 'required',
            'productName' => 'required',
            'productPrice' => 'required',
            'productdescription' => 'required',
            'manufacturer' => 'required',
            'productImage' => 'required'
        ]);
        // // Check validation failure
        if ($validator->fails()) {
            // break point 
            return response()->json(['message'=>$validator->messages()],400);
        }
      
        //update all columns of product info table
        $editedproduct= DB::update('update productinfo set 
                                    productinfo.productCode=:pc
                                    ,
                                    productinfo.productName=:pn
                                    ,
                                    productinfo.productPrice=:pp
                                    ,
                                    productinfo.productdescription=:pd
                                    ,
                                    productinfo.manufacturer=:m
                                    where productCode=:productinfo',
                                        ['productinfo' =>$productinfo,
                                        'pc' =>$request['productCode'],
                                        'pn' =>$request['productName'],
                                        'pp' =>$request['productPrice'],
                                        'pd' =>$request['productdescription'],
                                        'm' =>$request['manufacturer']]);
    //update product image
    $editedimage= DB::update('update productimages set 
    productimages.productCode=:pc
    where productCode=:productinfo',
        ['productinfo' =>$productinfo,
        'pc' =>1
        ]);
      return response()->json(['message'=>'Success'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productinfo  $productinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($productinfo)
    {
        DB::table('productinfo')
             ->where('productinfo.productCode','=',$productinfo)
             ->delete();
        return response()->json(['message'=>'Success'],200);
    }

    public function searchProduct(Request $request){
        // dd($request);
        $searchFor = $request->productName;
        $result = DB::table('productinfo')
                        ->select('productinfo.*')
                        ->where('productinfo.productName', 'like', "%{$searchFor}%")
                        ->get();
        return response()->json(['result'=>$result],200);
    }
}
