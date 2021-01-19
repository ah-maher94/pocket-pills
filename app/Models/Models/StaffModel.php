<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    use HasFactory;

    protected $table = "staffinfo";
    public $timestamps = false;
    protected $fillable=[
        'staffId',
        'branchId',
        'staffName',
        'salary',
        'firingDtate',
        'hiringDtate',
        'staffCategory',
        'staffEmail',
    ];

}
