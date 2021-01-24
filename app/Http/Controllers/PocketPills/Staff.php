<?php

namespace App\Http\Controllers\PocketPills;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Models\StaffModel;
use App\Models\staffdepartment;

use App\Models\Models\StaffPhoneModel;
use Validator;


class Staff extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('staffinfo')
            ->join('staffphoneinfo', 'staffinfo.staffId', '=', 'staffphoneinfo.staffId')
            ->select('staffinfo.*', 'staffphoneinfo.staffPhone')
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
        // dd($request);
        // $image=$request ->file('image');
        // $filename=rand().'.'.$image->getClientOriginalExtension();
        // $image->move(public_path('staffimages/'),$filename);
        // $filename='staffimages/'.$filename;
        $validated = $request->validate([
            'staffName' => 'required',
            'salary' => 'required',
            'hiringDate' => 'required',
            'staffDepartment' => 'required',
            // 'staffPhone' => 'required',
            'staffEmail' => 'required|unique:staffinfo|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        ]);

        if ($validated) {
        //    $x= StaffModel::create([
        //         'staffId' => $request['staffId'],
        //         'branchId' => $request['branchId'],
        //         'staffName' => $request['staffName'],
        //         'salary' => $request['salary'],
        //         'firingDtate' => $request['firingDtate'],
        //         'hiringDtate' => $request['hiringDtate'],
        //         'staffCategory' => $request['staffCategory'],
        //         'staffEmail' => $request['staffEmail'],
        //     ]);
        //    $y= StaffPhoneModel::create([
        //         // 'staffId' => $request['staffId'],
        //         'staffPhone'  => $request['staffPhone']
        //     ]);
        //     if($x && $y){
        //         DB::commit();
        //     }else{
        //         DB::rollBack();
        //     }

            DB::table('staffinfo')->insert(array(
                // 'staffId' => $request['staffId'],
                'branchId' => $request['branchId'],
                'staffName' => $request['staffName'],
                'salary' => $request['salary'],
                'hiringDate' => $request['hiringDate'],
                'staffDepartment' => $request['staffDepartment'],
                'staffEmail' => $request['staffEmail'],
                ));

                $id = DB::getPdo()->lastInsertId();

               DB::table('staffphoneinfo')->insert(array(
                    'staffId' =>$id,
                    'staffPhone'  => $request['staffPhone'],
                ));
           

        }

        return response()->json(['message'=>"success"],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($staffId)
    {


        return DB::table('staffinfo')
            ->join('staffphoneinfo', 'staffinfo.staffId', '=', 'staffphoneinfo.staffId')
            ->select('staffinfo.*', 'staffphoneinfo.staffPhone')
            ->where('staffinfo.staffId', '=', $staffId)
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
    public function update(Request $request, $staffId)
    {

        $editedstaff = DB::update(
            'update staffinfo set
        staffinfo.staffName=:staffName ,
        staffinfo.salary=:salary ,
        staffinfo.firingDtate=:firingDtate ,
        staffinfo.hiringDtate=:hiringDtate ,
        staffinfo.staffCategory=:staffCategory, 
        staffinfo.staffEmail=:staffEmail 
        
     
        where staffId=:staffinfo',
            [
                'staffinfo' => $staffId,
                'staffName' => $request['staffName'],
                'salary' => $request['salary'],
                'firingDtate' => $request['firingDtate'],
                'hiringDtate' => $request['hiringDtate'],
                'staffCategory' => $request['staffCategory'],
                'staffEmail' => $request['staffEmail'],
            ]
        );


        $editedstaffcontact = DB::update(
            'update staffphoneinfo set
       staffphoneinfo.staffPhone=:staffPhone 
       where staffId=:staffphoneinfo',
            [
                'staffphoneinfo' => $staffId, 'staffPhone' => $request['staffPhone'],
            ]
        );

        return $editedstaff;
        return $editedstaffcontact;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($staffId)
    {
        return DB::table('staffinfo')
            ->where('staffinfo.staffId', '=', $staffId)
            ->delete();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDepartment(Request $request )
    {
        return  DB::table('staffdepartment')
        ->where("branchId","=",$request['branchId'])
        ->select('staffdepartment.departmentName')
        ->get();
    }
    public function postDepartment(Request $request )
    {
        staffdepartment::create([
            'departmentName'=>$request['departmentName'],
            'branchId'=>$request['branchId'],
        ]);
    }
}
