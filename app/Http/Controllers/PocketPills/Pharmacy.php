<?php

namespace App\Http\Controllers\PocketPills;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Models\PharmacyModel;
use Validator;

class Pharmacy extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('pharmacyinfo')
            ->select('pharmacyinfo.*')
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
            'pharmacyName' => 'required|unique:pharmacyinfo',
        ]);

        if ($validated) {
            PharmacyModel::create([
                'pharmacyId' => $request['pharmacyId'],
                'pharmacyName'  => $request['pharmacyName'],
                'userId'  => $request['userId'],
                'pharmacyImage'  => $request['pharmacyImage'],
            ]);
        }
        else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $pharmacyId
     * @return \Illuminate\Http\Response
     */
    public function show($pharmacyId)
    {
        return DB::table('pharmacyinfo')
            ->select('pharmacyinfo.*')
            ->where('pharmacyinfo.pharmacyId', '=', $pharmacyId)
            ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $pharmacyId
     * @return \Illuminate\Http\Response
     */
    public function edit($pharmacyId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $pharmacyId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pharmacyId)
    {
        $editedpharmacryname = DB::update(
            'update pharmacyinfo set
        pharmacyinfo.pharmacyName=:pharmacyName 
        where pharmacyId=:pharmacyinfo',
            [
                'pharmacyinfo' => $pharmacyId, 'pharmacyName' => $request['pharmacyName'],
            ]
        );

        return $editedpharmacryname;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pharmacyId
     * @return \Illuminate\Http\Response
     */
    public function destroy($pharmacyId)
    {
        return DB::table('pharmacyinfo')
            ->where('pharmacyinfo.pharmacyId', '=', $pharmacyId)
            ->delete();
    }
}
