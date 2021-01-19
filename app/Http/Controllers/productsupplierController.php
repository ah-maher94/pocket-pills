<?php

namespace App\Http\Controllers;

use App\Models\productsupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class productsupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productsuppliers=productsupplier::all();
        return $productsuppliers;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'supplierId' => ['required','numeric'],
            'productCode' => ['required','numeric'],
        ]);
        // // Check validation failure
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->messages()],400);
        }
    
        //insert new record in category table
        productsupplier::create([
            'supplierId'=>$request['supplierId'],
            'productCode'=>$request['productCode']
        ]);
        
        return response()->json(['message'=>'Success'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productsupplier  $productsupplier
     * @return \Illuminate\Http\Response
     */
    public function show($supplierId)
    {
        //
        $supplier = DB::table('productsupplier')
        ->select('productsupplier.*')
        ->where('productsupplier.supplierId','=',$supplierId)
        ->get();
        return $supplier;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\productsupplier  $productsupplier
     * @return \Illuminate\Http\Response
     */
    public function edit(productsupplier $productsupplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productsupplier  $productsupplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$supplierId)
    {
        //
        $validator = Validator::make($request->all(), [
            'supplierId' => ['required','numeric'],
            'productCode' => ['required','numeric'],
        ]);
        // // Check validation failure
        if ($validator->fails()) {
            // break point 
            return response()->json(['message'=>$validator->messages()],400);
        }
        //update all columns of product info table
        $editedProductSupplier= DB::update('update productsupplier set 
                                    productsupplier.productCode=:pc
                                    where supplierId=:sid',
                                        ['sid' =>$supplierId,
                                        'pc' =>$request['productCode']]);
 
       return response()->json(['message'=>'Success'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productsupplier  $productsupplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($productCode)
    {
        //
        DB::table('productsupplier')
        ->where('productsupplier.productCode','=',$productCode)
        ->delete();
         return response()->json(['message'=>'Success'],200);
    }
}
