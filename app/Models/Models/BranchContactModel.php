<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchContactModel extends Model
{
    use HasFactory;

    protected $table = "branchcontactinfo";
    public $timestamps = false;
    protected $fillable=[
    'pharmacyId',
    'branchId ',
    'phoneNumber'
    ];
}
