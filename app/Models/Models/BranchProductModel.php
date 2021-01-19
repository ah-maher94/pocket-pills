<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchProductModel extends Model
{
    use HasFactory;
    
    
    protected $table = "branchproduct";
    public $timestamps = false;
    protected $fillable=[
        'pharmacyId',
        'productCode',
        'branchId',
        'productQuantity', 
    ];


}
