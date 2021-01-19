<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchModel extends Model
{
    use HasFactory;
    
    protected $table = "branchinfo";
    public $timestamps = false;
    protected $fillable=[
        'branchId',
        'pharmacyId',
        'branchOwner',
        'branchCountry',
        'branchCity',
        'branchregion',
        'branchStreet',
        'userId'
        
    ];
}
