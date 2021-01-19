<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User\UserInfo;
use App\Models\User\UserInvoice;
use App\Models\productinfo;
use App\Models\BranchModel;

class UserInvoiceController extends Controller
{
    public function getAllInvoices(){
        return DB::table('userInv')
        ->join('invoiceDetails', 'userInv.invNo', 'invoiceDetails.invNo')
        ->join('userInfo', 'userInfo.userId', 'userInv.userId')
        ->join('productInfo', 'productInfo.productCode', 'invoiceDetails.productCode')
        ->select('userInv.*', 'productInfo.*', 'invoiceDetails.productQuantity')
        ->where('userInfo.userId', '=', 4)
        ->orderBy('invDate', 'desc')
        ->get();
    }

    public function getAllInvoicesPharmacy($branchId){
        return DB::table('userInv')
        ->join('invoiceDetails', 'userInv.invNo', 'invoiceDetails.invNo')
        ->join('userInfo', 'userInfo.userId', 'userInv.userId')
        ->join('productInfo', 'productInfo.productCode', 'invoiceDetails.productCode')
        ->select('userInv.*', 'productInfo.*', 'userInfo.userName', 'invoiceDetails.productQuantity')
        ->where('invoiceDetails.branchId', '=', $branchId)
        ->orderBy('invDate', 'desc')
        ->get();
    }

    public function getInvoice($invId){
        return DB::table('userInv')
        ->join('invoiceDetails', 'userInv.invNo', 'invoiceDetails.invNo')
        ->join('userInfo', 'userInfo.userId', 'userInv.userId')
        ->join('productInfo', 'productInfo.productCode', 'invoiceDetails.productCode')
        ->select('userInv.invDate', 'productInfo.*', 'invoiceDetails.productQuantity')
        ->where('userInfo.userId', '=', 4)
        ->where('userInv.invNo', '=', $invId)
        ->get();
    }

    public function addInvoice(Request $request){

        // dd($request);
        DB::beginTransaction();
        try{
            // save to db
            DB::table('userInv')->insert([
                "invDate"=>now(),
                "userId"=>4,
            ]);

            
            // get last inserted id
            $invId = DB::getPdo()->lastInsertId();
            
            // insert user locations
            $productCode=$request->productCode;
            $productQuantity=$request->productQuantity;
            $branchId=$request->branchId;
            $userCartProducts = array();
            for($temp=0; $temp< count($productCode); $temp++)
            {                
                $userCartProducts[] =[
                    'invNo'=> $invId,
                    'productCode' => $productCode[$temp],
                    'productQuantity' => $productQuantity[$temp],
                    'branchId' => $branchId[$temp],
                    ];                 
                
            }
            DB::table('invoiceDetails')->insert($userCartProducts);

            DB::commit();

            // return redirect()->route('home');
            return response()->json(['message' => 'success'], 200);

        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'exist'], 409); 
            // return $e;

        }
    
    }

    public function deleteInvoice($invId){
        return DB::table('userInv')
        ->where('invNo', '=', $invId)
        ->delete();
    }

}
