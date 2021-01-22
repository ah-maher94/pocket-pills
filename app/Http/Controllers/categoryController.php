<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\cart;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys=category::all();
        
        // for ($i=0; $i < count($categorys); $i++) { 
        //     # code...
        //     $temp=$categorypath;
        //     // $temp.=`\`;
        //     $temp.=$categorys[$i]['categoryImage'];
        //     $categorys[$i]['categoryImage']=$temp;
        // }
        return $categorys;
        // return ;
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request){
        cart::create([
            'userId'=>$request['userId'],
            'productCode'=>$request['productCode'],
            'productQuantity'=>$request['productQuantity'],
            'branchId'=>$request['branchId'],
        ]);
        return response()->json(['message'=>'Success'],200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //,
        // 'categoryImage'
        $validator = Validator::make($request->all(), [
            'categoryName' => 'required',
            'categoryImage' => 'required',
        ]);
        // // Check validation failure
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->messages()],400);
        }
    
        //insert new record in category table
        category::create([
            'CategoryName'=>$request['categoryName'],
            'categoryImage'=>$request['categoryImage']
        ]);
        
        return response()->json(['message'=>'Success'],200);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($categoryName)
    {
        //
        $category = DB::table('category')
        ->select('category.*')
        ->where('category.categoryName','=',$categoryName)
        ->get();
        return $category;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoryName)
    {
        //
        $validator = Validator::make($request->all(), [
            'categoryName' => 'required',
            'categoryImage' => 'required',
        ]);
        // // Check validation failure
        if ($validator->fails()) {
            // break point 
            return response()->json(['message'=>$validator->messages()],400);
        }
        //update all columns of product info table
        $editedcategory= DB::update('update category set 
                                    category.categoryName=:cn
                                    ,
                                    category.categoryImage=:ci
                                    where categoryName=:categoryName',
                                        [
                                        'ci' =>$request['categoryImage'],
                                        'cn' =>$request['categoryName'],
                                        'categoryName' =>$categoryName]);
 
      return response()->json(['message'=>'Success'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoryName)
    {
        //
        DB::table('category')
        ->where('category.categoryName','=',$categoryName)
        ->delete();
         return response()->json(['message'=>'Success'],200);
    }
}
