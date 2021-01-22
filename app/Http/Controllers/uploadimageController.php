<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class uploadimageController extends Controller
{
    //
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadStaffImage(Request $request)
    {
        # code...
     
        // return redirect(route('staffStor',[$request]));
    }
    public function uploadAdminImage(Request $request)
    {
        # code...
        $image=$request ->file('image');
        $filename=rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('adminimages/'),$filename);
        $filename='adminimages/'.$filename;
        return response()->json(['message'=>$request ->file('image')],200);
    }
    public function uploadUserImage(Request $request)
    {
        # code...
        $image=$request ->file('image');
        $filename=rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('userimages/'),$filename);
        $filename='userimages/'.$filename;
        return response()->json(['message'=>$request ->file('image')],200);
    }
    public function uploadProductImage(Request $request)
    {
        # code...
        $image=$request ->file('image');
        $filename=rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('productimages/'),$filename);
        $filename='productimages/'.$filename;
        return response()->json(['message'=>$request ->file('image')],200);
    }
    public function uploadCategoryImage(Request $request)
    {
        # code...
        $image=$request ->file('image');
        $filename=rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('categoryimages/'),$filename);
        $filename='categoryimages/'.$filename;
        return response()->json(['message'=>$request ->file('image')],200);
    }
}
