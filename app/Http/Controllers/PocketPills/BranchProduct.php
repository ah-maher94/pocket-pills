<?php

namespace App\Http\Controllers\PocketPills;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Models\BranchProductModel;
use Illuminate\Support\Facades\Validator;


class BranchProduct extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return DB::table('branchproduct')
            ->select('branchproduct.*')
            ->get();
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
        $validated = $request->validate([
            'productQuantity' => 'required|integer|not_in:0',
        ]);

        if ($validated) {
            BranchProductModel::create([
                'pharmacyId' => $request['pharmacyId'],
                'productCode'  => $request['productCode'],
                'branchId' => $request['branchId'],
                'productQuantity'  => $request['productQuantity']
            ]);
        }
        else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($branchId)
    {
        return DB::table('branchproduct')
            ->select('branchproduct.*')
            ->where('branchproduct.branchId', '=', $branchId)
            ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productCode)
    {
        $editedquantity = DB::update(
            'update branchproduct set
        branchproduct.productQuantity=:productQuantity 
        where productCode=:branchproduct',
            [
                'branchproduct' => $productCode, 'productQuantity' => $request['productQuantity'],
            ]
        );

        return $editedquantity;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($branchId)
    {
        return DB::table('branchproduct')
            ->where('branchproduct.branchId', '=', $branchId)
            ->delete();
    }
}
