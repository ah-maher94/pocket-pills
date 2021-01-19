<?php

namespace App\Http\Controllers\PocketPills;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Models\BranchModel;
use App\Models\Models\BranchContactModel;
use Illuminate\Support\Facades\Validator;


class Branch extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('branchinfo')
            ->join('branchcontactinfo', 'branchinfo.branchId', '=', 'branchcontactinfo.branchId')
            ->select('branchinfo.*', 'branchcontactinfo.phoneNumber')
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
            'branchOwner' => 'required',
            'branchCountry' => 'required',
            'branchCity' => 'required',
            'phoneNumber' => 'required',
            'pharmacyId' => 'required',
        ]);

        if ($validated) {

            BranchModel::create([
                'branchId' => $request['branchId'],
                'pharmacyId' => $request['pharmacyId'],
                'branchOwner' => $request['branchOwner'],
                'branchCountry' => $request['branchCountry'],
                'branchCity' => $request['branchCity'],
                'branchregion' => $request['branchregion'],
                'branchStreet' => $request['branchStreet'],
                'userId' => $request['userId'],
            ]);
            
            $id = DB::getPdo()->lastInsertId();

            BranchContactModel::create([
                'branchId' => $id,
                'pharmacyId' => $request['pharmacyId'],
                'phoneNumber'  => $request['phoneNumber']
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


        return DB::table('branchinfo')
            ->join('branchcontactinfo', 'branchinfo.branchId', '=', 'branchcontactinfo.branchId')
            ->select('branchinfo.*', 'branchcontactinfo.phoneNumber')
            ->where('branchinfo.branchId', '=', $branchId)
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
    public function update(Request $request, $branchId)
    {
        $editedbranch = DB::update(
            'update branchinfo set
         branchinfo.branchOwner=:bowner 
         ,branchinfo.branchCountry=:bcountry 
        ,branchinfo.branchCity=:bcity 
        ,branchinfo.branchregion=:bregion 
        ,branchinfo.branchStreet=:bstreet 
         where branchId=:branchinfo',
            [
                'branchinfo' => $branchId,
                'bowner' => $request['branchOwner'],
                'bcountry' => $request['branchCountry'],
                'bcity' => $request['branchCity'],
                'bregion' => $request['branchregion'],
                'bstreet' => $request['branchStreet'],
            ]
        );
        $editedbranchcontact = DB::update(
            'update branchcontactinfo set
        branchcontactinfo.phoneNumber=:bphone 
        where branchId=:branchcontactinfo',
            [
                'branchcontactinfo' => $branchId,
                'bphone' => $request['phoneNumber'],
            ]
        );
        return $editedbranch;
        return $editedbranchcontact;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($branchId)
    {
        return DB::table('branchinfo')
            ->where('branchinfo.branchId', '=', $branchId)
            ->delete();
    }
}
