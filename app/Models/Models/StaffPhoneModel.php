<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffPhoneModel extends Model
{
    use HasFactory;
    protected $table = "staffphoneinfo";
    public $timestamps = false;
    protected $fillable = [
        'staffId',
        'staffPhone',

    ];
}
