<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class supplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers=supplier::all();
        return $suppliers;
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
            'supplierName' => 'required',
            'supplierPhone' => ['required','numeric'],
            'supplierAddress' => 'required'
        ]);
        // // Check validation failure
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->messages()],400);
        }
    
        //insert new record in category table
        supplier::create([
            'supplierName'=>$request['supplierName'],
            'supplierPhone'=>$request['supplierPhone'],
            'supplierAddress'=>$request['supplierAddress']
        ]);
        
        return response()->json(['message'=>'Success'],200);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($supplierId)
    {
        //
        $supplier = DB::table('suppliers')
        ->select('suppliers.*')
        ->where('suppliers.supplierId','=',$supplierId)
        ->get();
        return $supplier;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $supplierId)
    {
        //
        $validator = Validator::make($request->all(), [
            'supplierName' => 'required',
            'supplierPhone' => ['required','numeric'],
            'supplierAddress' => 'required',
        ]);
        // // Check validation failure
        if ($validator->fails()) {
            // break point 
            return response()->json(['message'=>$validator->messages()],400);
        }
        //update all columns of product info table
        $editedSupplier= DB::update('update suppliers set 
                                    suppliers.supplierName=:sn
                                    ,
                                    suppliers.supplierPhone=:sp
                                    ,
                                    suppliers.supplierAddress=:sa
                                    where supplierId=:sid',
                                        ['sid' =>$supplierId,
                                        'sn' =>$request['supplierName'],
                                        'sp' =>$request['supplierPhone'],
                                        'sa' =>$request['supplierAddress']]);
 
       return response()->json(['message'=>'Success'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($supplierId)
    {
        //
        DB::table('suppliers')
        ->where('suppliers.supplierId','=',$supplierId)
        ->delete();
         return response()->json(['message'=>'Success'],200);
    }
}

