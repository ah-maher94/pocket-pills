<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyModel extends Model
{
    use HasFactory;
    protected $table = "pharmacyinfo";
    public $timestamps = false;
    protected $fillable=[
        'pharmacyId',
        'pharmacyName', 
        'userId',     
        'pharmacyImage'
    ];
}
